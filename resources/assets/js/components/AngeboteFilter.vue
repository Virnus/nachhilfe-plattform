<template>
    <div class="card is-shady">
        <header class="card-header">
            <p class="card-header-title">
                Filter
            </p>
        </header>
        <div class="card-content">
            <div class="field">
                <div class="control">
                    <div class="select is-fullwidth">
                        <select v-model="subjectId" name="subject_id">
                            <option value="">-- Fach --</option>
                            <option v-for="subject in response.subjects" :value="subject.id">
                                {{ subject.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <div class="select is-fullwidth">
                        <select v-model="topicId" name="topic_id" :disabled="!subjectId">
                            <option value="">-- Thema --</option>
                            <option v-if="subjectId" v-for="(topic, id) in response.topics" :value="id">
                                {{ topic }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <button class="button is-primary" @click.prevent="push" :disabled="!response.topics">Filtern</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['base'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            subjectId: '',
            topicId: '',
            response: {
                subjects: [],
                topics: {}
            }
        }
    },
    watch: {
        subjectId: {
            handler: 'getResults'
        }
    },
    methods: {
        getSubjects() {
            return axios
                .get(`${this.base}/webapi/subjects`)
                .then(response => (this.response.subjects = response.data))
        },
        getResults() {
            return axios
                .get(`${this.base}/webapi/topics?subject=${this.subjectId}`)
                .then(response => (this.response.topics = response.data))
        },
        push() {
            location.assign(`${this.base}/?subject=${this.subjectId}&topic=${this.topicId}`)
        }
    },
    created() {
        this.getSubjects()
    }
}
</script>
