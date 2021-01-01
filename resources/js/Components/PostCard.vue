<template>
	<v-card
		v-if="img != ''"
		elevation="3"
		:max-width="width"
		tile
		class="mx-auto rounded-lg"
	>
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
						><v-icon color="red">mdi-delete-outline</v-icon>
					</template>
				</confirm-dialog>
			</div>
		</v-card-title>

		<v-divider class="mx-4"></v-divider>
		<v-card-text>
			{{ post.body }}
		</v-card-text>
		<v-card-text class="d-flex justify-between px-5">
			<span class="font-weight-thin font-italic">
				{{ post.date }}
			</span>
			<v-badge
				v-if="post.total_comments != ''"
				color="grey"
				:content="post.total_comments"
				overlap
			>
				<v-icon>
					mdi-comment-multiple
				</v-icon>
			</v-badge>
		</v-card-text>
		<v-card-actions class="d-flex">
			<user-badge
				:imgSize="badgeImgSize"
				:imgUrl="post.user.profile_photo_url"
				:userBadge="post.user"
				:tagName="post.user.tag.name"
				:isFollower="post.is_follower"
				style="max-width: 300px"
			>
			</user-badge>
			<v-spacer></v-spacer>
			<v-divider vertical v-if="post.liked != undefined"></v-divider>
			<div v-if="post.liked != undefined" class="d-flex">
				<v-btn
					icon
					@click="$emit('like', { id: post.id, liked: post.liked })"
				>
					<v-icon>{{
						post.liked ? 'mdi-heart' : 'mdi-heart-outline'
					}}</v-icon>
				</v-btn>
				<v-btn
					icon
					@click="
						$emit('bookmark', {
							id: post.id,
							bookmarked: post.bookmarked
						})
					"
				>
					<v-icon>{{
						post.bookmarked
							? 'mdi-bookmark'
							: 'mdi-bookmark-outline'
					}}</v-icon>
				</v-btn>
			</div>
		</v-card-actions>
	</v-card>
	<v-skeleton-loader
		v-else
		class="mx-auto"
		type="card, article, list-item-avatar"
		max-width="344"
		loading
	></v-skeleton-loader>
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
		width: { type: Number, default: 344 },
		badgeImgSize: { type: Number, default: 25 }
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
