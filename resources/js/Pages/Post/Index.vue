<template>
	<v-container>
		<form-dialog>
			<template #btn
				><v-icon color="primary">mdi-plus-thick</v-icon>
			</template>
		</form-dialog>

		<v-row>
			<v-col v-for="post in posts" :key="post.id" cols="12" md="6" lg="4">
				<post-card
					:post="post"
					:badgeImgSize="50"
					@like="like"
					@bookmark="bookmark"
				></post-card>
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
		like(post) {
			if (post.liked) {
				this.$inertia.delete(
					route('like', { post: post.id }),
					{ preserveScroll: true },
					{
						onSuccess: () => {
							this.$inertia.reload({
								only: ['posts'],
								preserveScroll: true
							})
						},
						onError: errors => {
							console.log(errors)
						},
						onFinish: () => {}
					}
				)
			} else {
				this.$inertia.post(
					route('like', { post: post.id }),
					{ preserveScroll: true },
					{
						onSuccess: () => {
							this.$inertia.reload({
								only: ['posts'],
								preserveScroll: true
							})
						},
						onError: errors => {
							console.log(errors)
						},
						onFinish: () => {}
					}
				)
			}
		},
		bookmark(post) {
			if (post.bookmarked) {
				this.$inertia.delete(
					route('removeBookmark', { post: post.id }),
					{ preserveScroll: true },
					{
						onSuccess: () => {
							this.$inertia.reload({
								only: ['posts'],
								preserveScroll: true
							})
						},
						onError: errors => {
							console.log(errors)
						},
						onFinish: () => {}
					}
				)
			} else {
				this.$inertia.post(
					route('bookmark', { post: post.id }),
					{ preserveScroll: true },
					{
						onSuccess: () => {
							this.$inertia.reload({
								only: ['posts'],
								preserveScroll: true
							})
						},
						onError: errors => {
							console.log(errors)
						},
						onFinish: () => {}
					}
				)
			}
		}
	}
}
</script>

<style></style>
