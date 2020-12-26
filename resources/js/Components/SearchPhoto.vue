<template>
	<v-container>
		<v-row>
			<v-text-field
				label="Search"
				v-model="search"
				outlined
			></v-text-field>
		</v-row>

		<v-row v-if="showPhotos">
			<v-col
				v-for="photo in photos"
				:key="photo.id"
				class="d-flex child-flex"
				cols="4"
			>
				<v-hover v-slot="{ hover }">
					<v-card
						:elevation="hover ? 12 : 2"
						:class="{ 'on-hover': hover }"
						class="rounded-lg"
						@click="selectedPhoto(photo)"
					>
						<v-img :src="photo.urls.thumb" aspect-ratio="1">
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
					</v-card>
				</v-hover>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
export default {
	data() {
		return {
			search: '',
			photos: Array,

			showPhotos: false
		}
	},
	methods: {
		async getPhotos() {
			const response = await fetch(
				`https://api.unsplash.com/search/photos?client_id=${process.env.MIX_UNSPLASH_ACCESS_KEY}&query=${this.search}`
			)
			const data = await response.json()
			this.photos = data.results
		},
		selectedPhoto(photo) {
			this.photo = photo
			this.search = ''
			this.$emit('selected-photo', photo)
			this.showPhotos = false
		}
	},
	watch: {
		search() {
			this.getPhotos()
			this.showPhotos = true
		}
	}
}
</script>

<style></style>
