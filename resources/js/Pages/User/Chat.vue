<template>
	<v-row class="mt-5">
		<v-col cols="4">
			<v-list rounded>
				<v-list-item-group v-model="selectedChatIndex" color="primary">
					<v-subheader>Chats</v-subheader>
					<v-list-item v-for="chat in chats" :key="chat.id">
						<v-list-item-avatar>
							<v-img
								:alt="`${chat.messages[0].receiver_id} avatar`"
								:src="
									chat.messages[0].sender_id === $page.user.id
										? chat.messages[0].receiver
												.profile_photo_url
										: chat.messages[0].sender
												.profile_photo_url
								"
							></v-img>
						</v-list-item-avatar>

						<v-list-item-content>
							<v-list-item-title
								v-text="
									chat.messages[0].sender_id === $page.user.id
										? chat.messages[0].receiver.name
										: chat.messages[0].sender.name
								"
							></v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</v-list-item-group>
			</v-list>
		</v-col>
		<v-col cols="8">
			<chat-message :messages="messages" :selectedChat="selectedChat">
				<span
					class="font-italic font-weight-thin text-caption"
					v-if="activeUser"
					>{{ activeUser.name }} is typing...
				</span>
			</chat-message>

			<v-text-field
				@keydown="sendTypingEvent"
				@keyup.enter="sendMessage"
				v-model="newMessage"
				type="text"
				name="message"
				placeholder="Enter your message..."
			></v-text-field>
		</v-col>
	</v-row>
</template>

<script>
import Layout from '@/Layouts/Layout'
import ChatMessage from '../../Components/User/ChatMessage.vue'
import { Inertia } from '@inertiajs/inertia'

export default {
	components: { ChatMessage },
	layout: Layout,
	props: {
		chat: Object
	},
	data() {
		return {
			messages: [],
			chats: [],
			newMessage: '',
			users: [],
			selectedChatIndex: '',
			selectedChat: {},
			activeUser: false,
			typingTimer: false
		}
	},
	computed: {
		receiverId() {
			return this.selectedChat.receiver_id == this.$page.user.id
				? this.selectedChat.sender_id
				: this.selectedChat.receiver_id
		},
		form() {
			return {
				message: this.newMessage,
				receiver_id:
					this.selectedChat.messages[0].receiver_id ===
					this.$page.user.id
						? this.selectedChat.messages[0].sender_id
						: this.selectedChat.messages[0].receiver_id
			}
		}
	},
	created() {
		this.fetchChats()
	},
	methods: {
		fetchMessages() {
			axios
				.get(`/chat/fetchAllMessages/${this.selectedChat.id}`)
				.then(response => {
					this.messages = response.data
				})
		},
		fetchChats() {
			axios.get('/chat/fetchAllChats').then(response => {
				this.chats = response.data
				console.log(response.data)
			})
		},
		sendMessage() {
			axios.post('/chat/message', this.form).then(response => {
				this.messages.push(response.data)
			})
			this.newMessage = ''
		},
		sendTypingEvent() {
			Echo.private(`chat.${this.selectedChat.id}`).whisper('typing', {
				user: this.$page.user
			})
		}
	},
	watch: {
		selectedChatIndex() {
			if (this.selectedChatIndex == undefined) {
				this.messages = []
				this.selectedChat = {}
				return
			}
			this.selectedChat = this.chats[this.selectedChatIndex]
			this.fetchMessages()
			console.log(this.selectedChat.messages)
			Echo.private(`chat.${this.selectedChat.id}`)
				.listen('ChatMessage', e => {
					this.messages.push(e.message)
				})
				.listenForWhisper('typing', e => {
					this.activeUser = e.user
					if (this.typingTimer) {
						clearTimeout(this.typingTimer)
					}
					this.typingTimer = setTimeout(() => {
						this.activeUser = false
					}, 1000)
				})

			// Echo.join('chat')
			// 	.here(user => {
			// 		this.users = user
			// 	})
			// 	.joining(user => {
			// 		this.users.push(user)
			// 	})
			// 	.leaving(user => {
			// 		this.users = this.users.filter(u => u.id != user.id)
			// 	})
			// 	.listen('ChatEvent', event => {
			// 		this.messages.push(event.chat)
			// 	})
			// 	.listenForWhisper('typing', user => {
			// 		this.activeUser = user
			// 		if (this.typingTimer) {
			// 			clearTimeout(this.typingTimer)
			// 		}
			// 		this.typingTimer = setTimeout(() => {
			// 			this.activeUser = false
			// 		}, 1000)
			// 	})
		}
	}
}
</script>

<style scoped></style>
