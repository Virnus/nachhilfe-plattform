<template>
    <div class="nachhilfe-suche" ref="records">
        <input type="search" name="search" class="input" placeholder="Suchen..." v-model="query" @keyup.enter="searchRecords" @focus="openRecords" @keyup.esc="forceCloseRecords" />
        <div v-if="active"  class="nachhilfe-suche__records has-text-dark">
            <div v-if="response.angebote && response.angebote.length" class="nachhilfe-suche__angebote">
                <div class="nachhilfe-suche__header is-size-6 has-text-weight-semibold">
                    <span>Angebote</span>
                    <span class="tag is-info">
                        {{ response.angebote.length }} / {{ response.count.angebote }}
                    </span>
                </div>
                <div class="nachhilfe-suche__content is-size-6">
                    <ul>
                        <li v-for="angebot in response.angebote">
                            <a :href="angebot_url + angebot.id">
                                {{ angebot.title }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-if="response.lernzentrum && response.lernzentrum.length" class="nachhilfe-suche__Lernzentrum">
                <div class="nachhilfe-suche__header is-size-6 has-text-weight-semibold">
                    <span>Lernzentrum</span>
                    <div class="is-inline-block">
                        <span class="tag is-info">
                            {{ response.lernzentrum.length }} / {{ response.count.lernzentrum }}
                        </span>
                    </div>
                </div>
                <div class="nachhilfe-suche__content is-size-6">
                    <ul>
                        <li v-for="lernzentrum in response.lernzentrum">
                            <a :href="lernzentrum_url + lernzentrum.id">
                                {{ formatDate(new Date(lernzentrum.date)) }} - {{ lernzentrum.info }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-if="response.users && response.users.length" class="nachhilfe-suche__user">
                <div class="nachhilfe-suche__header is-size-6 has-text-weight-semibold">
                    <span>Benutzer</span>
                    <span class="tag is-info">
                        {{ response.users.length }} / {{ response.count.users }}
                    </span>
                </div>
                <div class="nachhilfe-suche__content is-size-6">
                    <ul>
                        <li v-for="user in response.users">
                            <a :href="user_url + user.email.split('@')[0]">
                                {{ user.name }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['endpoint'],
    data() {
        return {
            response: {},
            query: '',
            active: false
        }
    },
    computed: {
        search_url() {
            return this.endpoint + '/?search='
        },
        angebot_url() {
            return this.endpoint + '/?angebot='
        },
        lernzentrum_url() {
            return this.endpoint + '/lernzentrum/'
        },
        user_url() {
            return this.endpoint + '/users/'
        }
    },
    methods: {
        getRecords() {
            axios.get(`${this.endpoint}/webapi/search?q=${this.query}`).then(response => {
                this.response = response.data.data
            })
        },
        searchRecords() {
            location.assign(this.search_url + this.query)
        },
        forceCloseRecords(e) {
            this.active = false
        },
        openRecords(e) {
            this.active = true
        },
        closeRecords(e) {
            if (!this.getClosest(e.target, this.$refs.records)) {
                this.active = false
            }
        },
        formatDate(date) {
            const monthNames = [
                'Januar',
                'Februar',
                'März',
                'April',
                'Mai',
                'Juni',
                'Juli',
                'August',
                'September',
                'Oktober',
                'November',
                'Dezember'
            ]

            const day = date.getDate()
            const monthIndex = date.getMonth()
            const year = date.getFullYear()

            return day + '. ' + monthNames[monthIndex] + ' ' + year
        },
        getClosest(el, tag) {
            do {
                if (el === tag) {
                    // tag name is found! let's return it. :)
                    return true
                }
            } while ((el = el.parentNode))

            // not found :(
            return false
        }
    },
    watch: {
        query() {
            this.getRecords()
        }
    },
    mounted() {
        window.addEventListener('click', this.closeRecords)
    },
    destroyed() {
        window.removeEventListener('click', this.closeRecords)
    }
}
</script>

<style>
</style>
