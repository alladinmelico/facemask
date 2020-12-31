<template>
	<v-card>
		<v-card-title primary-title>Messages </v-card-title>
		<v-card-text>
			<v-list>
				<v-list-item
					v-for="message in messages"
					:key="message.id"
					class="ma-4"
				>
					<v-list-item-avatar
						v-if="message.receiver_id === $page.user.id"
					>
						<v-img
							:src="
								selectedChat.messages[0].receiver
									.profile_photo_url
							"
						></v-img>
					</v-list-item-avatar>
					<v-list-item-content
						v-text="message.message"
						:class="
							message.receiver_id === $page.user.id
								? 'rounded-r-lg'
								: 'rounded-l-lg'
						"
						class="pa-4 text-center light-blue lighten-5 black--text rounded-b-lg"
					>
					</v-list-item-content>

					<v-list-item-avatar
						v-if="message.receiver_id !== $page.user.id"
					>
						<v-img :src="$page.user.profile_photo_url"></v-img>
					</v-list-item-avatar>
				</v-list-item>
			</v-list>
		</v-card-text>
		<v-card-subtitle>
			<slot></slot>
		</v-card-subtitle>
	</v-card>
</template>

<script>
export default {
	props: {
		messages: Array,
		selectedChat: Object
	}
}
</script>

<style></style>
