<template>
	<app-layout>
		<button @click="showModal = !showModal">Show</button>
		<div class="grid gap-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
			<div v-for="post in posts" :key="post.id">
				<post-card :post="post"></post-card>
			</div>
		</div>
		<v-btn color="primary" depressed elevation="2">Yoww</v-btn>
		<modal :show="showModal" @close="showModal = false"> </modal>
	</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import PostCard from '@/Components/PostCard'
import Modal from '@/Jetstream/Modal'

export default {
	components: {
		AppLayout,
		PostCard,
		Modal
	},
	props: {
		posts: Array
	},
	data() {
		return {
			showModal: false
		}
	},
	methods: {}
}
</script>

<style></style>
