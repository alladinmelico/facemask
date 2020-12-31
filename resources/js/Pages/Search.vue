<template>
	<v-container>
		<v-row>
			<v-col>
				<v-card>
					<v-card-title primary-title>
						Search Results
					</v-card-title>
					<v-tabs v-model="tab" centered icons-and-text>
						<v-tabs-slider></v-tabs-slider>

						<v-tab href="#tab-1">
							Posts
							<v-icon>mdi-post</v-icon>
						</v-tab>

						<v-tab href="#tab-2">
							Comments
							<v-icon>mdi-comment</v-icon>
						</v-tab>

						<v-tab href="#tab-3">
							Users
							<v-icon>mdi-account</v-icon>
						</v-tab>
					</v-tabs>

					<v-tabs-items v-model="tab">
						<v-tab-item value="tab-1">
							<v-row class="pa-5">
								<v-col
									v-for="post in posts"
									:key="post.id"
									cols="12"
									md="6"
									lg="4"
								>
									<post-card
										:post="post"
										:badgeImgSize="50"
									></post-card>
								</v-col>
							</v-row>
						</v-tab-item>
						<v-tab-item value="tab-2">
							<v-row class="pa-5">
								<v-col
									v-for="comment in comments"
									:key="comment.id"
									cols="12"
									md="6"
									lg="4"
								>
									<v-card
										class="mx-auto"
										max-width="400"
										outlined
										hover
									>
										<v-card-text
											class="headline font-weight-bold"
										>
											{{ `"${comment.comment}"` }}
											<inertia-link
												:href="
													route(
														'post.show',
														comment.post_id
													)
												"
											>
												<v-btn small>Read Post</v-btn>
											</inertia-link>
										</v-card-text>

										<v-card-actions>
											<user-badge
												:userBadge="comment.user"
												:imgUrl="
													comment.user
														.profile_photo_url
												"
												:imgSize="40"
												:tagName="comment.user.tag.name"
												:isFollower="
													comment.is_follower
												"
											></user-badge>
										</v-card-actions>
									</v-card>
								</v-col>
							</v-row>
						</v-tab-item>
						<v-tab-item value="tab-3">
							<v-row class="pa-5">
								<v-col
									v-for="user in users"
									:key="user.id"
									cols="12"
									md="6"
									lg="4"
								>
									<v-card outlined hover>
										<user-badge
											:userBadge="user"
											:imgUrl="user.profile_photo_url"
											:imgSize="60"
											:nameSize="'header'"
											:tagName="user.tag.name"
											:isFollower="user.is_follower"
										>
										</user-badge>
										<v-container
											class="font-italic font-weight-thin text-right"
										>
											{{ user.email }}
										</v-container>
									</v-card>
								</v-col>
							</v-row>
						</v-tab-item>
					</v-tabs-items>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import Layout from '@/Layouts/Layout'
import PostCard from '@/Components/PostCard'
import UserBadge from '../Components/User/UserBadge.vue'

export default {
	layout: Layout,
	components: {
		PostCard,
		UserBadge
	},
	props: {
		posts: Array,
		comments: Array,
		users: Array
	},
	data() {
		return {
			tab: null
		}
	},
	methods: {
		mark(text) {
			const queryString = window.location.search
			const urlParams = new URLSearchParams(queryString)
			const term = urlParams.get('search')
			const regex = new RegExp(term, 'g')
			return text.replace(regex, '<span id="mark">' + term + '</span>')
		}
	}
}
</script>

<style></style>
