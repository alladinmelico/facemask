<template>
	<v-container>
		<v-row
			v-for="comment in comments"
			:key="comment.id"
			class="d-flex flex-column"
		>
			<strong>{{ comment.user.name }}</strong>

			<p class="ml-3">
				{{ comment.comment }}
				<v-btn @click="replyTo(comment.id)" icon color="primary"
					><v-icon>mdi-reply</v-icon></v-btn
				>
			</p>

			<v-container class="mb-5">
				<form
					v-if="commentId == comment.id"
					@submit.prevent="submit"
					class="d-flex align-center "
				>
					<v-text-field label="Reply" v-model="reply"></v-text-field>
					<v-btn class="mr-4" type="submit" icon color="primary">
						<v-icon>mdi-send</v-icon>
					</v-btn>
				</form>
			</v-container>
		</v-row>
	</v-container>
</template>

<script>
export default {
	props: {
		comments: Array,
		postId: Number
	},
	data() {
		return {
			commentId: '',
			reply: ''
		}
	},
	computed: {
		form() {
			return {
				post_id: this.postId,
				comment_id: this.commentId,
				comment: this.reply
			}
		}
	},
	methods: {
		submit() {
			this.$inertia.post('/reply/store', this.form)
			this.reply = ''
		},
		replyTo(commentId) {
			this.commentId = commentId
		}
	}
}
</script>

<style></style>
