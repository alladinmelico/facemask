require('./bootstrap')
require('moment')

import Vue from 'vue'
import Vuetify from 'vuetify'

import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaForm } from 'laravel-jetstream'
import PortalVue from 'portal-vue'
import VueChatScroll from 'vue-chat-scroll'

import 'vuetify/dist/vuetify.min.css'

Vue.mixin({ methods: { route } })
Vue.use(InertiaApp)
Vue.use(InertiaForm)
Vue.use(PortalVue)
Vue.use(Vuetify)
Vue.use(VueChatScroll)

const app = document.getElementById('app')

Vue.prototype.$route = (...args) => route(...args).url()

new Vue({
	vuetify: new Vuetify({
		theme: {
			themes: {
				dark: {
					primary: '#F5DF4D',
					secondary: '#939597',
					accent: '#624CF5',
					error: '#FF5252',
					info: '#2196F3',
					success: '#4CAF50',
					warning: '#FFC107'
				},
				light: {
					primary: '#635A1F',
					secondary: '#939597',
					accent: '#624CF5',
					error: '#FF5252',
					info: '#2196F3',
					success: '#4CAF50',
					warning: '#FFC107'
				}
			},
			dark: true
		}
	}),
	render: h =>
		h(InertiaApp, {
			props: {
				initialPage: JSON.parse(app.dataset.page),
				resolveComponent: name =>
					import(`./Pages/${name}`).then(module => module.default)
			}
		})
}).$mount(app)
