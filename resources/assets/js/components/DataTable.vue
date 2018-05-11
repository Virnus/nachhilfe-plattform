<template>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                {{ title || response.table }}
            </p>
            <div class="card-header-icon">
                <a href="#" class="button is-info is-small" v-if="response.allow.creation" @click.prevent="creating.active = !creating.active">
                    {{ creating.active ? 'Cancel' : 'New Record' }}
                </a>
            </div>
        </header>
        <div class="card-content">
            <div class="box" v-if="creating.active">
                <div class="media-content">
                    <div class="content">
                        <form action="#" class="control" @submit.prevent="store">
                            <div class="field" v-for="column in response.updatable">
                                <label class="label" :for="column">{{ response.custom_columns[column] || column }}</label>

                                <template v-if="response.custom_types[column] && response.custom_types[column].includes('select')">
                                    <div class="select is-fullwidth" :class="{'is-danger': creating.errors[column]}">
                                        <select v-model="creating.form[column]" :id="column">
                                            <option v-for="(option, key) in getColumnTypeOptions(column)" :value="key">
                                                {{ option }}
                                            </option>
                                        </select>
                                    </div>
                                </template>
                                <template v-else-if="response.custom_types[column] && response.custom_types[column].includes('checkbox')">
                                    <input :id="column" class="switch is-rounded" :class="{'is-danger': creating.errors[column]}" type="checkbox" v-model="creating.form[column]">
                                    <label :for="column">
                                        {{ response.custom_columns[column] || column }}?
                                    </label>
                                </template>
                                <template v-else>
                                    <input :id="column" :type="response.custom_types[column] || 'text'" :placeholder="column" class="input" :class="{'input is-danger': creating.errors[column]}" v-model="creating.form[column]">
                                </template>
                                <p class="help is-danger" v-if="creating.errors[column]">
                                    {{creating.errors[column][0]}}
                                </p>
                            </div>
                            <div class="field">
                                <input type="submit" class="button is-primary" value="Create" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="field">
                <form action="#" @submit.prevent="getRecords">
                    <label class="label" for="search">Search</label>
                    <div class="columns">
                        <div class="column is-3">
                            <div class="select is-fullwidth">
                                <select v-model="search.column">
                                    <option :value="column" v-for="column in response.displayable">
                                        {{ response.custom_columns[column] || column }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="column is-3">
                            <div class="select is-fullwidth">
                                <select v-model="search.operator">
                                    <option value="equals">=</option>
                                    <option value="contains">beinhaltet</option>
                                    <option value="starts_with">startet mit</option>
                                    <option value="ends_with">endet mit</option>
                                    <option value="greater_than">grösser als</option>
                                    <option value="less_than">kleiner als</option>
                                </select>
                            </div>
                        </div>
                        <div class="column is-6">
                            <div class="field has-addons">
                                <div class="control is-expanded">
                                    <input class="input" type="search" id="search" v-model="search.value" />
                                </div>
                                <div class="control">
                                    <input class="button" type="submit" value="Search" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="field">
                <div class="columns">
                    <div class="column is-10">
                        <div class="control">
                            <label class="label" for="filter">Quick search current results</label>
                            <input type="text" id="filter" class="input" v-model="quickSearchQuery">
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="control is-fullwidth">
                            <label class="label" for="limit">Display records</label>
                            <div class="select is-fullwidth">
                                <select id="limit" v-model="limit" @change="getRecords">
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                    <option value="">All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table is-striped is-fullwidth is-responsive">
                <thead>
                    <tr>
                        <th v-for="column in response.displayable">
                            <span class="sortable" @click="sortBy(column)">
                                {{ response.custom_columns[column] || column }}
                            </span>
                            <div class="arrow" v-if="sort.key === column" :class="{'arrow--asc': sort.order === 'asc', 'arrow--desc': sort.order === 'desc'}"></div>
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="record in filteredRecords">
                        <td v-for="columnValue, column in record">
                            <template v-if="editing.id === record.id && isUpdatable(column)">
                                <div class="field">
                                    <template v-if="response.custom_types[column] && response.custom_types[column].includes('select')">
                                        <div class="select" :class="{'is-danger': editing.errors[column]}">
                                            <select v-model="editing.form[column]">
                                                <option v-for="(option, key) in getColumnTypeOptions(column)" :value="key">
                                                    {{ option }}
                                                </option>
                                            </select>
                                        </div>
                                    </template>
                                    <template v-else-if="response.custom_types[column] && response.custom_types[column].includes('checkbox')">
                                        <input :id="'editing-checkbox-' + column" class="switch is-rounded is-small" :class="{'is-danger': editing.errors[column]}" type="checkbox" v-model="editing.form[column]">
                                        <label :for="'editing-checkbox-' + column"></label>
                                    </template>
                                    <template v-else>
                                        <input :type="response.custom_types[column] || 'text'" class="input" :class="{'input is-danger': editing.errors[column]}" v-model="editing.form[column]">
                                    </template>
                                    <p class="help is-danger" v-if="editing.errors[column]">
                                        {{editing.errors[column][0]}}
                                    </p>
                                </div>
                            </template>
                            <template v-else>
                                {{columnValue}}
                            </template>
                        </td>
                        <td>
                            <a href="#" class="button is-info is-small" @click.prevent="edit(record)" v-if="editing.id !== record.id">Bearbeiten</a>

                            <template v-if="editing.id === record.id">
                                <div class="field is-fullwidth">
                                    <div class="buttons">
                                        <a href="#" class="button is-success is-small" @click.prevent="update">Save</a>
                                        <a href="#" class="button is-warning is-small" @click.prevent="editing.id = null">Cancel</a>
                                    </div>
                                </div>
                            </template>
                        </td>
                        <td>
                            <a href="#" class="button is-danger is-small" @click.prevent="destroy(record.id)" v-if="response.allow.deletion">Löschen</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import queryString from 'query-string'

export default {
    props: ['endpoint', 'title'],
    data() {
        return {
            response: {
                table: '',
                displayable: [],
                records: [],
                allow: {}
            },
            sort: {
                key: 'id',
                order: 'asc'
            },
            quickSearchQuery: '',
            limit: 50,
            editing: {
                id: null,
                errors: [],
                form: {}
            },
            search: {
                value: '',
                operator: 'equals',
                column: 'id'
            },
            creating: {
                active: false,
                form: {},
                errors: []
            }
        }
    },
    computed: {
        filteredRecords() {
            let data = this.response.records

            data = data.filter(row => {
                return Object.keys(row).some(key => {
                    return (
                        String(row[key])
                            .toLowerCase()
                            .indexOf(this.quickSearchQuery.toLowerCase()) > -1
                    )
                })
            })

            if (this.sort.key) {
                data = _.orderBy(
                    data,
                    i => {
                        let value = i[this.sort.key]

                        if (!isNaN(parseFloat(value))) {
                            return parseFloat(value)
                        }
                        return String(i[this.sort.key]).toLowerCase()
                    },
                    this.sort.order
                )
                return data
            }
        }
    },
    methods: {
        getRecords() {
            return axios.get(`${this.endpoint}?${this.getQueryParameters()}`).then(response => {
                this.response = response.data.data
            })
        },
        getQueryParameters() {
            return queryString.stringify({
                limit: this.limit,
                ...this.search
            })
        },
        sortBy(column) {
            this.sort.key = column
            this.sort.order = this.sort.order === 'asc' ? 'desc' : 'asc'
        },
        edit(record) {
            this.editing.errors = []
            this.editing.id = record.id
            this.editing.form = _.pick(record, this.response.updatable)
        },
        isUpdatable(column) {
            return this.response.updatable.includes(column)
        },
        update() {
            axios
                .patch(`${this.endpoint}/${this.editing.id}`, this.editing.form)
                .then(() => {
                    this.getRecords().then(() => {
                        this.editing.id = null
                        this.editing.form = null
                    })
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.editing.errors = error.response.data.errors
                    }
                })
        },
        store() {
            axios
                .post(`${this.endpoint}`, this.creating.form)
                .then(() => {
                    this.getRecords().then(() => {
                        this.creating.active = false
                        this.creating.form = {}
                        this.creating.errors = []
                    })
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.creating.errors = error.response.data.errors
                    }
                })
        },
        destroy(record) {
            if (!window.confirm(`Datensatz wirklich löschen?`)) {
                return
            }

            axios.delete(`${this.endpoint}/${record}`).then(() => {
                this.getRecords()
            })
        },
        toObject(arr, int) {
            let rv = {}
            for (let i = 0; i < arr.length; ++i) {
                const tempArr = arr[i].split(':')
                rv[tempArr[0]] = tempArr[int]
            }
            return rv
        },
        getColumnTypeOptions(column) {
            const options = this.response.custom_types[column]
                .split('|')
                .pop()
                .split(',')

            return this.toObject(options, options[0].includes(':') ? 1 : 0)
        }
    },
    mounted() {
        this.getRecords()
    }
}
</script>

<style lang="scss">
.sortable {
    cursor: pointer;
}
.arrow {
    display: inline-block;
    vertical-align: middle;
    width: 0;
    height: 0;
    margin-left: 5px;
    opacity: 0.6;

    &--asc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #222;
    }
    &--desc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-bottom: 4px solid #222;
    }
}
</style>
