/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('data-table', require('./components/DataTable.vue'))
Vue.component('lernzentrum-status', require('./components/LernzentrumStatus.vue'))
Vue.component('lernzentrum-anmeldung', require('./components/LernzentrumAnmeldung.vue'))
Vue.component('tags-input', require('./components/TagsInput.vue'))
Vue.component('contact-modal', require('./components/ContactModal.vue'))
Vue.component('nachhilfe-suche', require('./components/NachhilfeSuche.vue'))
Vue.component('angebot-create', require('./components/AngebotCreate.vue'))

const app = new Vue({
    el: '#app'
})

// Bulma NavBar Burger Script
document.addEventListener('DOMContentLoaded', function() {
    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(
        document.querySelectorAll('.navbar-burger'),
        0
    )

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {
        // Add a click event on each of them
        $navbarBurgers.forEach(function($el) {
            $el.addEventListener('click', function() {
                // Get the target from the "data-target" attribute
                let target = $el.dataset.target
                let $target = document.getElementById(target)

                // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                $el.classList.toggle('is-active')
                $target.classList.toggle('is-active')
            })
        })
    }

    // Get all "Notification" elements
    const $notifications = Array.prototype.slice.call(document.querySelectorAll('.notification'), 0)

    // Check if there are any Notifications
    if ($notifications.length > 0) {
        // Add a click event on each of them
        $notifications.forEach(function($el) {
            $el.querySelector('.delete').addEventListener('click', function() {
                // Remove the Notification on click
                $el.remove()
            })
        })
    }
})
