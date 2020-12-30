<template>
	<v-container>
		<v-row v-if="img !== ''">
			<v-img :src="img.urls.regular" max-height="400" class="rounded-lg">
				<template v-slot:placeholder>
					<v-row
						class="fill-height ma-0"
						align="center"
						justify="center"
					>
						<v-progress-circular
							indeterminate
							color="grey lighten-5"
						></v-progress-circular>
					</v-row>
				</template>
			</v-img>
		</v-row>
		<v-row class="p-5">
			<h2>
				{{ post.name }}
			</h2>
			<p>
				{{ post.body }}
			</p>
		</v-row>
		<v-container class="p-8">
			<h5>Comments</h5>
			<v-divider></v-divider>
			<comment :comments="comments" :postId="post.id"></comment>
		</v-container>
		<v-container class="mt-5">
			<form @submit.prevent="submit">
				<v-text-field
					label="Comment"
					v-model="comment"
					required
					autofocus
				></v-text-field>
				<v-btn class="mr-4" type="submit">
					Comment
				</v-btn>
			</form>
		</v-container>
	</v-container>
</template>

<script>
import Layout from '@/Layouts/Layout'
import Comment from '@/Components/Post/Comment'

export default {
	layout: Layout,
	components: {
		Comment
	},
	props: {
		post: Object,
		comments: Array
	},
	data() {
		return {
			img: '',
			comment: ''
		}
	},
	mounted() {
		this.getImage()
	},
	computed: {
		form() {
			return {
				post_id: this.post.id,
				comment: this.comment
			}
		}
	},
	methods: {
		submit() {
			this.$inertia.post('/comment', this.form)
			this.comment = ''
		},
		async getImage() {
			try {
				const response = await fetch(
					`https://api.unsplash.com/photos/${this.post.cover_id}?client_id=${process.env.MIX_UNSPLASH_ACCESS_KEY}`
				)
				const data = await response.json()
				this.img = data
			} catch (error) {
				console.log(error)
			}
		}
	}
}
</script>

<style></style>
