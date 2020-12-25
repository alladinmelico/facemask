<template>
	<div
		class="flex flex-col shadow-md bg-white rounded-lg hover:shadow-lg border-2"
	>
		<img
			:src="imgUrl"
			:alt="img.alt_description"
			class="object-cover rounded-t-lg"
		/>
		<h3 class="font-bold">{{ post.name }}</h3>
		<p class="p-3">{{ post.body }}</p>
		<a href="">{{ post.email }}</a>
	</div>
</template>

<script>
export default {
	props: {
		post: Object
	},
	data() {
		return {
			img: {},
			imgUrl: ''
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
