<template>
	<v-app>
		<v-app-bar fixed elevation="5" app>
			<v-app-bar-nav-icon
				@click.stop="drawer = !drawer"
			></v-app-bar-nav-icon>
			<v-avatar :tile="true">
				<v-img :src="'../storage/img/logo.png'" alt="logo"></v-img>
			</v-avatar>
			<v-toolbar-title v-if="!$vuetify.breakpoint.xs" class="ml-3"
				>facemask</v-toolbar-title
			>

			<v-spacer></v-spacer>

			<v-text-field
				append-icon="mdi-magnify"
				dense
				single-line
				hide-details
				v-model="searchTerm"
				@keyup.enter="search"
			></v-text-field>

			<v-spacer></v-spacer>
			<v-switch
				v-model="$vuetify.theme.dark"
				inset
				:label="$vuetify.breakpoint.xs ? '' : 'Dark Mode'"
				class="mt-5"
			/>
		</v-app-bar>

		<v-navigation-drawer
			v-model="drawer"
			fixed
			temporary
			height="100vh"
			app
		>
			<v-list-item>
				<v-list-item-avatar>
					<v-img
						v-if="$page.jetstream.managesProfilePhotos"
						:src="$page.user.profile_photo_url"
						:alt="$page.user.name"
					></v-img>
				</v-list-item-avatar>
				<v-list-item-content>
					<inertia-link :href="route('user.show', $page.user.id)">
						<v-list-item-title>{{
							$page.user.name
						}}</v-list-item-title>
					</inertia-link>
				</v-list-item-content>
			</v-list-item>
			<navigation-list></navigation-list>
			<template v-slot:append>
				<div class="pa-2">
					<form method="POST" @submit.prevent="logout">
						<v-btn block type="submit">
							Logout
						</v-btn>
					</form>
				</div>
			</template>
		</v-navigation-drawer>

		<v-main class="">
			<v-responsive max-width="1200" class="mx-auto">
				<slot></slot>
			</v-responsive>
		</v-main>
		<app-footer app></app-footer>
	</v-app>
</template>

<script>
import NavigationList from '../Components/NavigationList.vue'
import AppFooter from '../Components/AppFooter'
import ApplicationLogo from '../Jetstream/ApplicationLogo'

export default {
	components: { NavigationList, AppFooter, ApplicationLogo },
	data: () => ({
		links: ['Dashboard', 'Messages', 'Profile', 'Updates'],
		drawer: false,
		searchTerm: ''
	}),
	methods: {
		logout() {
			axios.post(route('logout').url()).then(response => {
				window.location = '/'
			})
		},
		search() {
			if (this.searchTerm !== '') {
				this.$inertia.get(route('search'), { search: this.searchTerm })
			}
		}
	}
}
</script>
