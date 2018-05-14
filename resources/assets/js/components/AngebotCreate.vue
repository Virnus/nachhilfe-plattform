<template>
    <div class="angebot-erstellen">
        <form :action="base + '/account/angebot'" method="post" ref="form">
            <input type="hidden" name="_token" :value="csrf">
            <div class="field">
                <label class="label">Titel</label>
                <div class="control">
                    <input id="title" name="title" type="text" class="input" placeholder="Titel" v-model="title">
                </div>
            </div>
            <div class="field">
                <label class="label">Info</label>
                <div class="control">
                    <textarea id="info" name="info" class="textarea" v-model="info"></textarea>
                </div>
            </div>
            <div class="field">
                <label class="label">In welchem Fach möchtest du Nachhilfe geben?</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select v-model="subject" name="subject_id">
                            <option value="">Wähle ein Fach aus</option>
                            <option v-for="subject in response.subjects" :value="subject.id">
                                {{ subject.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">In welchem Thema?</label>
                <div class="control">
                    <tags-input element-id="topics"
                    v-model="topics"
                    :existing-tags="response.topics"
                    :typeahead="true"
                    :disable="!subject"
                    placeholder="Themen, Schwerpunkte, etc.">
                </tags-input>
            </div>
        </div>
        <div class="field">
            <button class="button is-primary" @click="submit">Erstellen</button>
        </div>
    </form>
</div>
</template>


<script>
export default {
    props: ['base'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            title: '',
            info: '',
            subject: '',
            topics: [],

            response: {
                topics: {},
                subjects: []
            }
        }
    },
    watch: {
        subject: {
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
            .get(`${this.base}/webapi/topics?subject=${this.subject}&name=`)
            .then(response => (this.response.topics = response.data))
        },
        submit() {
            this.$refs.form.submit()
        }
    },
    created() {
        this.getSubjects()
        console.log(this.base + '/account/angebote')
    }
}
</script>
