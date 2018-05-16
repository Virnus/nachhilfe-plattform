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
                <button class="button is-primary is-fullwidth" @click.prevent="push" :disabled="!subjectId" :title="!subjectId ? 'Zuerst Fach auswählen' : ''">Filtern</button>
            </div>
            <div class="field" v-if="subjectId || topicId">
                <button class="button is-info is-fullwidth" @click.prevent="reset">Filter zurücksetzten</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['base', 'action', 'subject', 'topic'],
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
            location.assign(`${this.action}/?subject=${this.subjectId}&topic=${this.topicId}`)
        },
        reset() {
            this.subjectId = ''
            this.topicId = ''
            if (this.subject || this.topic) {
                location.assign(`${this.action}/`)
            }
        }
    },
    created() {
        this.subjectId = this.subject
        this.topicId = this.topic
        this.getSubjects()
    }
}
</script>
