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
				<span>{{ this.tag }}</span>
			</v-tooltip>
		</v-badge>
		<v-badge
			bordered
			v-if="name != ''"
			color="grey darken-2"
			:icon="isPrivate ? 'mdi-lock' : 'mdi-lock-open-variant'"
			class="text-right"
		>
			<inertia-link :href="userUrl">
				<span :class="nameSize">{{ name }}</span>
			</inertia-link>
		</v-badge>
		<slot></slot>
	</v-container>
</template>

<script>
export default {
	props: {
		imgUrl: { type: String, default: '' },
		imgSize: Number,
		isPrivate: { type: Boolean, default: true },
		tag: { type: String, default: 'Staying at Home' },
		name: { type: String, default: '' },
		nameSize: { type: String, default: '' },
		userUrl: { type: String, default: '' }
	},
	computed: {
		icon() {
			switch (this.tag) {
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
		}
	}
}
</script>

<style></style>
