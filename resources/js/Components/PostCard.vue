<template>
	<v-card elevation="3" max-width="344" tile class="mx-auto rounded-lg">
		<v-img class="white--text align-end" height="200px" :src="imgUrl">
		</v-img>
		<v-card-title>{{ post.name }}</v-card-title>

		<v-divider class="mx-4"></v-divider>
		<v-card-text>
			{{ post.body }}
		</v-card-text>
	</v-card>
</template>

<script>
export default {
	props: {
		post: Object
	},
	data() {
		return {
			img: {},
			imgUrl: '',
			loading: false
		}
	},
	mounted() {
		this.getImage()
	},
	methods: {
		async getImage() {
			try {
				const response = await fetch(
					`https://api.unsplash.com/photos/${this.post.cover_id}?client_id=${process.env.MIX_UNSPLASH_ACCESS_KEY}`
				)
				const data = await response.json()
				this.img = data
				this.imgUrl = data.urls.thumb
			} catch (error) {
				console.log(error)
			}
		}
	}
}
</script>

<style></style>
