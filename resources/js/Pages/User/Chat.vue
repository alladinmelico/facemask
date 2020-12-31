<template>
	<v-row class="mt-5">
		<v-col cols="4">
			<v-list rounded id="chatList">
				<v-list-item-group
					v-model="selectedChatIndex"
					color="primary"
					mandatory
				>
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
			<chat-message
				v-if="selectedChat.id !== undefined"
				:messages="messages"
				:selectedChat="selectedChat"
			>
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
				this.getUrlParam()
			})
		},
		sendMessage() {
			axios.post('/chat/message', this.form).then(response => {
				if (this.selectedChat.id != undefined) {
					this.messages.push(response.data)
				} else {
					this.selectedChatIndex = null
					this.fetchChats()
				}
			})
			this.newMessage = ''
		},
		sendTypingEvent() {
			if (this.selectedChat.id != undefined) {
				Echo.private(`chat.${this.selectedChat.id}`).whisper('typing', {
					user: this.$page.user
				})
			}
		},
		getUrlParam() {
			const queryString = window.location.search
			const urlParams = new URLSearchParams(queryString)
			const userId = urlParams.get('user')

			if (userId !== null) {
				this.chats.forEach((chat, index) => {
					if (chat.messages[0].receiver_id == userId) {
						this.selectedChatIndex = index
						return
					}
				})

				if (this.selectedChatIndex === '') {
					axios.get('/user/getUser/' + userId).then(response => {
						this.chats.push({
							messages: [
								{
									sender: response.data,
									receiver: this.$page.user,
									sender_id: response.data.id,
									receiver_id: this.$page.user.id
								}
							]
						})
						this.selectedChatIndex = this.chats.length - 1
					})
				}
			}
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
			if (this.selectedChat.id != undefined) {
				this.fetchMessages()
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
			}
		}
	}
}
</script>

<style scoped>
#chatList {
	max-height: 70vh;
	overflow-y: scroll;
}
</style>
