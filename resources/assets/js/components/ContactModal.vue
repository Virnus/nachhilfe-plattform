<template>
    <div class="contact-modal">
        <button class="button is-primary is-outlined is-fullwidth" @click="openModal">Kontaktieren</button>
        <div class="modal" :class="{ 'is-active': isActive }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Nachricht an {{ name }}</p>
                    <button class="delete" aria-label="close" @click.prevent="closeModal"></button>
                </header>
                <section class="modal-card-body">
                    <form :action="action" method="post" ref="form">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="field">
                          <label class="label">Betreff</label>
                          <div class="control">
                            <input class="input" type="text" name="title" id="title" placeholder="Betreff">
                          </div>
                        </div>
                        <div class="field">
                          <label class="label">Text</label>
                          <div class="control">
                            <textarea class="textarea" name="content" id="content" rows="8" cols="80"></textarea>
                          </div>
                        </div>
                    </form>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" @click.prevent="closeModal">Abbrechen</button>
                    <button class="button is-primary" @click="submit">Senden</button>
                </footer>
            </div>
            <button class="modal-close is-large"></button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['action', 'name'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            isActive: false
        }
    },
    methods: {
        openModal() {
            this.isActive = true
        },
        closeModal() {
            this.isActive = false
        },
        submit() {
            this.$refs.form.submit()
        }
    }
}
</script>

<style>
</style>
