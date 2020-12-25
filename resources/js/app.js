require('./bootstrap')
require('moment')

import Vue from 'vue'
import Vuetify from 'vuetify'

import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaForm } from 'laravel-jetstream'
import PortalVue from 'portal-vue'

import 'vuetify/dist/vuetify.min.css'

Vue.mixin({ methods: { route } })
Vue.use(InertiaApp)
Vue.use(InertiaForm)
Vue.use(PortalVue)
Vue.use(Vuetify)

const app = document.getElementById('app')

Vue.prototype.$route = (...args) => route(...args).url()

new Vue({
	render: h =>
		h(InertiaApp, {
			props: {
				initialPage: JSON.parse(app.dataset.page),
				resolveComponent: name =>
					import(`./Pages/${name}`).then(module => module.default)
			}
		})
}).$mount(app)
