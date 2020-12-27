<template>
	<v-dialog v-model="dialog" persistent max-width="290">
		<template v-slot:activator="{ on, attrs }">
			<v-btn icon dark v-bind="attrs" v-on="on"
				><slot name="btn"></slot
			></v-btn>
		</template>
		<v-card>
			<v-card-title class="headline">
				{{ headline }}
			</v-card-title>
			<v-card-text>{{ message }}</v-card-text>
			<v-card-actions>
				<v-spacer></v-spacer>
				<v-btn color="gray darken-1" text @click="confirm(false)">
					Cancel
				</v-btn>
				<v-btn color="red darken-1" text @click="confirm(true)">
					{{ proceedText }}
				</v-btn>
			</v-card-actions>
		</v-card>
	</v-dialog>
</template>

<script>
export default {
	props: {
		headline: { type: String, default: 'Confirm' },
		message: String,
		proceedText: { type: String, default: 'Yes' }
	},
	data() {
		return {
			dialog: false
		}
	},
	methods: {
		confirm(confirm) {
			this.$emit('confirm', confirm)
			this.dialog = false
		}
	}
}
</script>
