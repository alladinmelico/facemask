<template>
	<v-list nav dense>
		<v-list-item-group active-class="deep-primary--text text--accent-4">
			<v-list-item>
				<v-list-item-title>
					<inertia-link :href="$route('user.index')"
						>Users</inertia-link
					>
				</v-list-item-title>
			</v-list-item>

			<v-list-item>
				<v-list-item-title
					><inertia-link :href="$route('post.index')"
						>Posts</inertia-link
					>
				</v-list-item-title>
			</v-list-item>
		</v-list-item-group>
	</v-list>
</template>
<script>
export default {}
</script>

<style></style>
