<template>
	<v-container class="comment ml-2">
		<v-row
			v-for="comment in comments"
			:key="comment.id"
			class="d-flex flex-column ml-1"
		>
			<strong>{{ comment.user.name }}</strong>

			<p class="ml-3">
				{{ comment.comment }}
				<v-btn @click="replyTo(comment.id)" icon color="primary"
					><v-icon>mdi-reply</v-icon></v-btn
				>
			</p>

			<v-container>
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
			<v-container>
				<comment
					v-if="comment.replies.length > 0"
					:comments="comment.replies"
					:postId="comment.commentable_id"
				></comment>
			</v-container>
		</v-row>
	</v-container>
</template>

<script>
import Comment from '@/Components/Post/Comment'

export default {
	name: 'Comment',
	components: { Comment },
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
	mounted() {
		console.log(this.comments)
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

<style>
.comment {
	border-left: solid 3px transparent;
}
.comment:hover {
	border-left-color: lightgray;
}
</style>
