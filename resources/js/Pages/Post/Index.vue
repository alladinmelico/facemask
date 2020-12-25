<template>
	<app-layout>
		<div class="grid gap-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
			<div v-for="post in posts" :key="post.id">
				<post-card :post="post"></post-card>
			</div>
		</div>
	</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import PostCard from '@/Components/PostCard'

export default {
	components: {
		AppLayout,
		PostCard
	},
	props: {
		posts: Array
	}
}
</script>

<style></style>
