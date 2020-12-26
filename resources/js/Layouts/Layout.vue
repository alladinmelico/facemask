<template>
	<v-app>
		<v-app-bar
			absolute
			elevate-on-scroll
			scroll-target="#scrolling-techniques-7"
			app
		>
			<v-app-bar-nav-icon
				@click.stop="drawer = !drawer"
			></v-app-bar-nav-icon>

			<v-toolbar-title>Title</v-toolbar-title>

			<v-spacer></v-spacer>

			<v-btn icon>
				<v-icon>mdi-magnify</v-icon>
			</v-btn>

			<v-btn icon>
				<v-icon>mdi-heart</v-icon>
			</v-btn>

			<v-btn icon>
				<v-icon>mdi-dots-vertical</v-icon>
			</v-btn>
		</v-app-bar>

		<v-navigation-drawer v-model="drawer" absolute bottom temporary>
			<navigation-list></navigation-list>
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
	})
}
</script>
