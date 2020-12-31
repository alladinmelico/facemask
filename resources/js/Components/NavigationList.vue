<template>
	<v-list nav dense>
		<v-list-item-group active-class="deep-primary--text text--accent-4 ">
			<div v-for="item in items" :key="item.title">
				<inertia-link :href="item.route">
					<v-list-item ripple class="pa-1">
						<v-list-item-icon>
							<v-hover v-slot="{ hover }">
								<v-icon>{{
									hover ? item.icon : item.iconOutline
								}}</v-icon>
							</v-hover>
						</v-list-item-icon>

						<v-list-item-content>
							<v-list-item-title class="text-h6">
								{{ item.title }}
							</v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</inertia-link>
			</div>
		</v-list-item-group>
	</v-list>
</template>
<script>
export default {
	data() {
		return {
			items: [
				{
					title: 'Users',
					icon: 'mdi-account-group',
					iconOutline: 'mdi-account-group-outline',
					route: this.$route('user.index')
				},
				{
					title: 'Posts',
					icon: 'mdi-post',
					iconOutline: 'mdi-post-outline',
					route: this.$route('post.index')
				},
				{
					title: 'Chats',
					icon: 'mdi-message',
					iconOutline: 'mdi-message-outline',
					route: this.$route('chat')
				}
			]
		}
	}
}
</script>

<style></style>
