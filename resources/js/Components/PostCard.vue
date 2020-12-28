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
			<v-spacer></v-spacer>
			<div v-if="$page.user.id == post.user_id">
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
			</div>
		</v-card-title>

		<v-divider class="mx-4"></v-divider>
		<v-card-text>
			<p>
				{{ post.body }}
			</p>
			<p class="font-weight-thin font-italic">
				{{ post.created_at }}
			</p>
		</v-card-text>

		<v-card-actions class="d-flex">
			<user-badge
				:imgSize="25"
				:imgUrl="post.user.profile_photo_url"
				:isPrivate="post.user.is_private == 1 ? true : false"
				:name="post.user.name"
				:tag="post.user.tag.name"
				:userUrl="route('user.show', post.user.id)"
				style="max-width: 300px"
				><v-btn icon><v-icon>mdi-plus</v-icon></v-btn>
			</user-badge>
			<v-spacer></v-spacer>
			<v-divider vertical></v-divider>
			<div class="d-flex">
				<v-btn icon>
					<v-icon>mdi-heart-outline</v-icon>
				</v-btn>
				<v-btn icon>
					<v-icon>mdi-bookmark-outline</v-icon>
				</v-btn>
			</div>
		</v-card-actions>
	</v-card>
</template>

<script>
import ConfirmDialog from '@/Components/ConfirmDialog.vue'
import FormDialog from './Post/FormDialog.vue'
import UserBadge from './User/UserBadge.vue'

export default {
	components: {
		ConfirmDialog,
		FormDialog,
		UserBadge
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
