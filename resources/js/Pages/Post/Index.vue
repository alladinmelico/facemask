<template>
	<v-container>
		<form-dialog>
			<template #btn
				><v-icon color="primary">mdi-plus-thick</v-icon>
			</template>
		</form-dialog>

		<v-row>
			<v-col v-for="post in posts" :key="post.id" cols="12" md="6" lg="4">
				<post-card :post="post" @delete-post="deletePost"></post-card>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import Layout from '@/Layouts/Layout'
import PostCard from '../../Components/PostCard.vue'
import FormDialog from '@/Components/Post/FormDialog.vue'

export default {
	metaInfo() {
		return {
			title: `Posts`
		}
	},
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
	methods: {
		deletePost(postId) {}
	}
}
</script>

<style></style>
