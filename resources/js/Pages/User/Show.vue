<template>
	<v-container class="my-10">
		<v-row>
			<v-img
				:src="coverImg != '' ? coverImg.urls.regular : ''"
				:alt="userProfile.name"
				max-height="200"
				class="rounded-lg mx-auto"
			>
				<v-container v-if="canEdit">
					<v-dialog
						max-width="500px"
						transition="dialog-top-transition"
					>
						<template v-slot:activator="{ on, attrs }">
							<v-btn
								icon
								color="primary"
								dark
								v-bind="attrs"
								v-on="on"
								><v-icon>mdi-pencil</v-icon></v-btn
							>
						</template>
						<v-card>
							<v-card-title primary-title>
								Search Photo
							</v-card-title>
							<v-card-text>
								<search-photo
									@selected-photo="selectedPhoto"
								></search-photo>
							</v-card-text>
						</v-card>
					</v-dialog>
				</v-container>
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
		<v-row class="my-10">
			<v-col style="border-right: solid 1px lightgrey">
				<v-container class="flex justify-around items-center">
					<user-badge
						:imgSize="50"
						:imgUrl="userProfile.profile_photo_url"
						:isPrivate="userProfile.is_private == 1 ? true : false"
						:tag="userProfile.tag.name"
						:name="userProfile.name"
					>
					</user-badge>
					<v-btn color="primary" small
						>Follow <v-icon>mdi-plus</v-icon></v-btn
					>
				</v-container>
				<v-list rounded dense>
					<v-subheader>Followers</v-subheader>
					<v-list-item
						v-for="follower in userProfile.followers"
						:key="follower.id"
						link
					>
						<v-list-item-icon>
							<user-badge
								:imgSize="25"
								:imgUrl="follower.profile_photo_url"
							></user-badge>
						</v-list-item-icon>
						<v-list-item-content>
							<inertia-link
								:href="route('user.show', follower.id)"
							>
								<v-list-item-title>
									{{ follower.name }}
									<v-icon dense x-small>{{
										follower.is_private
											? 'mdi-lock'
											: 'mdi-lock-open-variant'
									}}</v-icon>
								</v-list-item-title>
							</inertia-link>
						</v-list-item-content>
					</v-list-item>
				</v-list>
				<v-list rounded dense>
					<v-subheader>Following</v-subheader>
					<v-list-item
						v-for="follow in userProfile.following"
						:key="follow.id"
						link
					>
						<v-list-item-icon>
							<user-badge
								:imgSize="25"
								:imgUrl="follow.profile_photo_url"
							></user-badge>
						</v-list-item-icon>
						<v-list-item-content>
							<inertia-link :href="route('user.show', follow.id)">
								<v-list-item-title>
									{{ follow.name }}
									<v-icon dense x-small>{{
										follow.is_private
											? 'mdi-lock'
											: 'mdi-lock-open-variant'
									}}</v-icon>
								</v-list-item-title>
							</inertia-link>
						</v-list-item-content>
					</v-list-item>
				</v-list>
			</v-col>
			<v-col cols="8">
				<h5 class="text-h5">
					Posts
					<form-dialog>
						<template #btn
							><v-icon color="primary">mdi-plus-thick</v-icon>
						</template>
					</form-dialog>
				</h5>
				<v-row v-if="canView" class="flex justify-around items-center">
					<v-container
						v-for="post in userProfile.posts"
						:key="post.id"
					>
						<post-card
							:post="post"
							:width="900"
							@delete-post="deletePost"
						></post-card>
					</v-container>
				</v-row>
				<v-row v-else class="mx-auto">
					<p>You need to follow this user to see the posts</p>
				</v-row>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import Layout from '@/Layouts/Layout'
import SearchPhoto from '../../Components/SearchPhoto.vue'
import PostCard from '../../Components/PostCard.vue'
import FormDialog from '@/Components/Post/FormDialog.vue'
import UserBadge from '../../Components/User/UserBadge.vue'

export default {
	components: { SearchPhoto, PostCard, FormDialog, UserBadge },
	layout: Layout,
	props: {
		userProfile: Object,
		canView: { type: Boolean, default: false },
		canEdit: { type: Boolean, default: false },
		tags: Array
	},
	data() {
		return { coverImg: '' }
	},
	mounted() {
		this.getImage()
	},
	methods: {
		async getImage() {
			try {
				const response = await fetch(
					`https://api.unsplash.com/photos/${this.userProfile.cover_id}?client_id=${process.env.MIX_UNSPLASH_ACCESS_KEY}`
				)
				const data = await response.json()
				this.coverImg = data
			} catch (error) {
				console.log(error)
			}
		},
		selectedPhoto(photo) {
			this.$inertia.post(route('updateCover'), {
				cover_id: photo.id,
				_method: 'PUT'
			})
		},
		deletePost(postId) {}
	},
	watch: {
		user() {
			this.getImage()
		}
	}
}
</script>

<style></style>
