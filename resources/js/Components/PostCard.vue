<template>
	<v-card elevation="3" :max-width="width" tile class="mx-auto rounded-lg">
		<v-img
			class="white--text align-end"
			height="200px"
			:src="img != '' ? img.urls.thumb : ''"
		>
		</v-img>
		<v-card-title>
			<inertia-link :href="route('post.show', post.id)">
				{{ post.name }}
			</inertia-link>
		</v-card-title>

		<v-divider class="mx-4"></v-divider>
		<v-card-text>
			{{ post.body }}
		</v-card-text>

		<v-card-actions v-if="$page.user.id == post.user_id">
			<v-spacer></v-spacer>
			<!-- <v-btn icon
				><v-icon color="primary">mdi-pencil-outline</v-icon></v-btn
			> -->
			<form-dialog :post="post">
				<template #btn
					><v-icon color="primary">mdi-pencil-outline</v-icon>
				</template>
			</form-dialog>
			<confirm-dialog
				:headline="'Are you sure you want to delete?'"
				:message="'This will permanently delete your post'"
				:proceedText="'Delete'"
				@confirm="confirmDelete"
			>
				<template #btn
					><v-icon color="red">mdi-delete</v-icon>
				</template>
			</confirm-dialog>
		</v-card-actions>
	</v-card>
</template>

<script>
import ConfirmDialog from '@/Components/ConfirmDialog.vue'
import FormDialog from './Post/FormDialog.vue'

export default {
	components: {
		ConfirmDialog,
		FormDialog
	},
	props: {
		post: Object,
		width: { type: Number, default: 344 }
	},
	data() {
		return {
			img: '',
			loading: false
		}
	},
	mounted() {
		this.getImage()
	},
	computed: {
		form() {
			return {
				_method: 'DELETE'
			}
		}
	},
	methods: {
		confirmDelete(confirmation) {
			if (confirmation) {
				this.$inertia.delete('/post/' + this.post.id)
			}
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
	},
	watch: {
		post() {
			this.getImage()
		}
	}
}
</script>

<style></style>
