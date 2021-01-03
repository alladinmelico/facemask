<template>
	<v-container>
		<v-row>
			<v-col v-for="stat in stats" :key="stat.text" cols="6" md="4">
				<v-card>
					<v-card-title v-text="stat.text"></v-card-title>
					<v-card-text
						class="display-3"
						v-text="stat.value"
					></v-card-text>
				</v-card>
			</v-col>
		</v-row>
		<v-subheader>News feed</v-subheader>
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
		<pagination :links="postLinks" />
	</v-container>
</template>

<script>
import Layout from '@/Layouts/Layout'
import PostCard from '@/Components/PostCard'
import Pagination from '@/Components/Pagination'

export default {
	layout: Layout,
	components: {
		PostCard,
		Pagination
	},
	props: {
		posts: Array,
		followers: Number,
		followings: Number,
		totalPosts: Number,
		postLinks: Array
	},
	computed: {
		stats() {
			return [
				{ text: 'Followers', value: this.followers },
				{ text: 'Followings', value: this.followings },
				{ text: 'Posts', value: this.totalPosts }
			]
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
