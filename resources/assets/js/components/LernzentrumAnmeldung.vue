<template>
    <div class="lernzentrum-anmeldung">

        <template v-if="angemeldet">
            <form :action="action + '/signout'" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <div class="field">
                    <label class="label">Du bist bereits angemeldet.</label>
                    <div class="controls">
                        <button class="button is-outlined is-danger is-fullwidth" type="submit" name="button">Abmelden</button>
                    </div>
                </div>
            </form>
        </template>
        <a v-else href="#" class="button is-primary is-fullwidth" @click.prevent="openModal">Anmelden</a>

        <div class="modal" :class="{ 'is-active': isActive }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Anmeldung Lernzentrum</p>
                    <button class="delete" aria-label="close" @click.prevent="closeModal"></button>
                </header>
                <section class="modal-card-body">
                    <form :action="action + '/signup'" method="post" ref="form">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="field">
                            <label class="label">In welchem Fach möchtest du dich verbessern?</label>
                            <div class="control">
                                <div class="select is-fullwidth">
                                    <select v-model="subject" name="subject_id">
                                        <option value="">Wählen ein Fach aus</option>
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
                    </form>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" @click.prevent="closeModal">Abbrechen</button>
                    <button class="button is-primary" @click="submit">Anmelden</button>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['angemeldet', 'action', 'base'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            isActive: false,
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
        openModal() {
            this.isActive = true
        },
        closeModal() {
            this.isActive = false
        },
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
    }
}
</script>
