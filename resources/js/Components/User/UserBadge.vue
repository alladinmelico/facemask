<template>
	<v-container class="d-flex justify-around items-center">
		<v-badge
			v-if="imgUrl != ''"
			avatar
			bordered
			overlap
			:icon="icon.icon"
			:color="icon.color"
		>
			<v-tooltip top>
				<template v-slot:activator="{ on, attrs }">
					<v-avatar :size="imgSize">
						<v-img :src="imgUrl" v-bind="attrs" v-on="on"></v-img>
					</v-avatar>
				</template>
				<span>{{ this.tagName }}</span>
			</v-tooltip>
		</v-badge>
		<v-badge
			bordered
			v-if="userBadge !== undefined"
			color="grey darken-2"
			:icon="userBadge.is_private ? 'mdi-lock' : 'mdi-lock-open-variant'"
			class="text-right"
		>
			<inertia-link :href="route('user.show', userBadge.id)">
				<span :class="nameSize">{{ userBadge.name }}</span>
			</inertia-link>
		</v-badge>
		<v-tooltip
			top
			v-if="userBadge !== undefined && userBadge.id !== $page.user.id"
		>
			<template #activator="{on}">
				<v-btn icon v-on="on" color="primary" @click="updateFollow"
					><v-icon>{{
						isFollower ? 'mdi-minus-box-outline' : 'mdi-plus-box'
					}}</v-icon></v-btn
				>
			</template>
			{{ isFollower ? 'Unfollow' : 'Follow' }}
		</v-tooltip>
		<v-hover
			v-if="userBadge !== undefined && userBadge.id !== $page.user.id"
			v-slot="{ hover }"
		>
			<inertia-link :href="`${route('chat')}/?user=${userBadge.id}`">
				<v-icon>
					{{ hover ? 'mdi-message' : 'mdi-message-outline' }}
				</v-icon>
			</inertia-link>
		</v-hover>
		<slot></slot>
	</v-container>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'

export default {
	props: {
		imgUrl: { type: String, default: '' },
		imgSize: { type: Number, default: '25' },
		userBadge: Object,
		nameSize: { type: String, default: '' },
		tagName: { type: String, default: 'Doctor' },
		isFollower: { type: Boolean, default: false }
	},
	mounted() {},
	computed: {
		icon() {
			switch (this.tagName) {
				case 'Staying at Home':
					return { color: 'primary', icon: 'mdi-home' }
					break
				case 'Positive':
					return { color: 'pink', icon: 'mdi-emoticon-sad' }
					break
				case 'Negative':
					return { color: 'teal', icon: 'mdi-account-check' }
					break
				case 'Quarantined':
					return { color: 'brown', icon: 'mdi-home-lock' }
					break
				case 'Survivor':
					return { color: 'indigo', icon: 'mdi-arm-flex' }
					break
				case 'Vaccinated':
					return { color: 'green', icon: 'mdi-shield-account' }
					break
				case 'Doctor':
					return { color: 'light-blue', icon: 'mdi-doctor' }
					break

				default:
					return { color: 'black', icon: 'mdi-account-question' }
					break
			}
		},
		form() {
			return { _method: 'DELETE', user: this.userBadge.id }
		}
	},
	methods: {
		updateFollow() {
			if (this.isFollower) {
				this.$inertia.delete('/unfollow/' + this.userBadge.id, {
					preserveScroll: true
				})
			} else {
				this.$inertia.post('/follow/' + this.userBadge.id, {
					preserveScroll: true
				})
				// TODO!: Preserve scroll not working
			}
		}
	}
}
</script>

<style></style>
