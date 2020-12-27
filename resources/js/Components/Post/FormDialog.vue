<template>
	<v-row justify="center">
		<v-dialog v-model="dialog" persistent max-width="600px">
			<template v-slot:activator="{ on, attrs }">
				<v-btn color="primary" dark v-bind="attrs" v-on="on">
					Open Dialog
				</v-btn>
			</template>
			<v-card>
				<v-card-title>
					<span class="headline">Create Post</span>
				</v-card-title>

				<v-card-text>
					<v-container>
						<search-photo
							@selected-photo="selectedPhoto"
						></search-photo>
						<v-row v-if="photo !== ''">
							<v-img
								:src="photo.urls.regular"
								max-height="400"
								class="rounded-lg"
							></v-img>
						</v-row>
						<form @submit.prevent="submit" class="mt-5">
							<v-text-field
								v-model="name"
								:error-messages="nameErrors"
								:counter="50"
								label="Title"
								required
								@input="$v.name.$touch()"
								@blur="$v.name.$touch()"
							></v-text-field>
							<!-- <div v-if="errors.name">{{ errors.name[0] }}</div> -->
							<v-textarea
								v-model="body"
								:error-messages="bodyErrors"
								label="Body"
								required
								@input="$v.body.$touch()"
								@blur="$v.body.$touch()"
							></v-textarea>
							<v-btn class="mr-4" @click="submit">
								submit
							</v-btn>
							<v-btn @click="clear">
								clear
							</v-btn>
						</form>
					</v-container>
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="blue darken-1" text @click="dialog = false">
						Close
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</v-row>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, maxLength, minLength } from 'vuelidate/lib/validators'
import SearchPhoto from '@/Components/SearchPhoto'

export default {
	mixins: [validationMixin],

	validations: {
		name: { required, maxLength: maxLength(50) },
		body: { required, minLength: minLength(3) }
	},

	components: {
		SearchPhoto
	},

	data: () => ({
		name: '',
		body: '',
		photo: '',
		dialog: false
	}),

	computed: {
		nameErrors() {
			const errors = []
			if (!this.$v.name.$dirty) return errors
			!this.$v.name.maxLength &&
				errors.push('Title must be at most 50 characters long')
			!this.$v.name.required && errors.push('Name is required.')
			return errors
		},
		bodyErrors() {
			const errors = []
			if (!this.$v.body.$dirty) return errors
			!this.$v.body.minLength &&
				errors.push('Name must be at least 3 characters short')
			!this.$v.body.required && errors.push('Body is required.')
			return errors
		},
		form() {
			return { name: this.name, body: this.body, cover_id: this.photo.id }
		}
	},

	methods: {
		submit() {
			this.$v.$touch()
			if (!this.$v.$invalid) {
				this.$inertia.post('/post', this.form)
				this.clear()
				this.dialog = false
			}
		},
		clear() {
			this.$v.$reset()
			this.name = ''
			this.body = ''
			this.photo = ''
		},
		selectedPhoto(photo) {
			this.photo = photo
		}
	}
}
</script>

<style></style>
