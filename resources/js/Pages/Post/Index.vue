<template>
	<v-container>
		<form-dialog></form-dialog>
		<v-row>
			<v-col v-for="post in posts" :key="post.id" cols="12" md="6" lg="4">
				<post-card :post="post"></post-card>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import Layout from '@/Layouts/Layout'
import PostCard from '../../Components/PostCard.vue'
import FormDialog from '../../Components/Post/FormDialog.vue'

export default {
	components: {
		PostCard,
		FormDialog
	},
	layout: Layout,
	props: { posts: Array },
	data() {
		return {
			showModal: false
		}
	},
	methods: {}
}
</script>

<style></style>
