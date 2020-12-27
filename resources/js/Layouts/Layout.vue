<template>
	<v-app>
		<v-app-bar absolute app>
			<v-app-bar-nav-icon
				@click.stop="drawer = !drawer"
			></v-app-bar-nav-icon>

			<v-toolbar-title>Title</v-toolbar-title>

			<v-spacer></v-spacer>

			<v-btn icon>
				<v-icon>mdi-magnify</v-icon>
			</v-btn>

			<v-switch
				v-model="$vuetify.theme.dark"
				inset
				label="Dark Mode"
				class="mt-5"
			/>
		</v-app-bar>

		<v-navigation-drawer
			v-model="drawer"
			absolute
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
					<v-list-item-title>{{ $page.user.name }}</v-list-item-title>
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
	</v-app>
</template>

<script>
import NavigationList from '../Components/NavigationList.vue'
export default {
	components: { NavigationList },
	data: () => ({
		links: ['Dashboard', 'Messages', 'Profile', 'Updates'],
		drawer: false
	}),
	methods: {
		logout() {
			axios.post(route('logout').url()).then(response => {
				window.location = '/'
			})
		}
	}
}
</script>
