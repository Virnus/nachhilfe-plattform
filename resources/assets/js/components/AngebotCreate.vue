<template>
    <div class="angebot-erstellen">
        <form :action="action" v-on:submit="validateForm" method="post" ref="form">
            <input type="hidden" name="_token" :value="csrf">
            <div class="field">
                <label class="label">Titel</label>
                <div class="control">
                    <input id="title" name="title" type="text" class="input" placeholder="Titel" v-model="title"  v-bind:class="{ 'is-danger': attemptSubmit && missingTitle }">
                </div>
                <p class="help is-danger" v-if="attemptSubmit && missingTitle">
                    Titel muss ausgefüllt sein.
                </p>
            </div>
            <div class="field">
                <label class="label">Info</label>
                <div class="control">
                    <textarea id="info" name="info" class="textarea" v-model="info" v-bind:class="{ 'is-danger': attemptSubmit && missingInfo }"></textarea>
                </div>
                <p class="help is-danger" v-if="attemptSubmit && missingInfo">
                    Info muss ausgefüllt sein.
                </p>
            </div>
            <div class="field">
                <label class="label">In welchem Fach möchtest du Nachhilfe geben?</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select v-model="subject" name="subject_id" v-bind:class="{ 'is-danger': attemptSubmit && missingSubject }">
                            <option value="">Wähle ein Fach aus</option>
                            <option v-for="subject in response.subjects" :value="subject.id">
                                {{ subject.name }}
                            </option>
                        </select>
                    </div>
                    <p class="help is-danger" v-if="attemptSubmit && missingSubject">
                        Fach muss ausgewählt sein.
                    </p>
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
            <button class="button is-primary" type="submit">Erstellen</button>
        </div>
    </form>
</div>
</template>


<script>
export default {
    props: ['base', 'action'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            title: '',
            info: '',
            subject: '',
            topics: [],
            attemptSubmit: false,

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
    computed: {
        missingTitle: function () { return this.title === ''; },
        missingInfo: function () { return this.title === ''; },
        missingSubject: function () { return this.title === ''; },
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
        },
        validateForm: function (event) {
            this.attemptSubmit = true;
            if (this.missingTitle || this.missingInfo || this.missingSubject) event.preventDefault();
        },

    },
    created() {
        this.getSubjects()
        console.log(this.base + '/account/angebote')
    }
}
</script>
