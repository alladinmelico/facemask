<template>
	<v-app>
		<v-app-bar app>
			<v-avatar class="mr-3" size="70">
				<a href="/">
					<v-img
						contain
						max-height="70%"
						:src="'../storage/img/logo.png'"
						alt="logo"
					></v-img>
				</a>
			</v-avatar>

			<v-toolbar-title class="font-weight-black headline">
				facemask
			</v-toolbar-title>
		</v-app-bar>
		<v-main class="d-flex justify-center items-center">
			<v-container>
				<v-row>
					<v-col cols="12" md="8" lg="6" class="mx-auto">
						<v-container id="logo" style="max-width:400px">
							<application-logo-small
								v-if="$vuetify.breakpoint.name == 'xs'"
								class="mx-auto"
								style="max-height:90px"
							></application-logo-small>
							<application-logo-banner
								v-else
								class="mx-auto"
								style="max-width:400px"
							></application-logo-banner>
						</v-container>

						<form @submit.prevent="submit">
							<input type="hidden" name="_token" :value="csrf" />

							<v-text-field
								v-model="form.email"
								:rules="emailRules"
								label="E-mail"
								required
								class="m-5"
								id="email"
								name="email"
								:error-messages="errors.email"
								:error="errors.email != undefined"
							></v-text-field>

							<v-text-field
								v-model="form.password"
								:append-icon="
									passShow ? 'mdi-eye' : 'mdi-eye-off'
								"
								:rules="passRules"
								:type="passShow ? 'text' : 'password'"
								label="Password"
								required
								class="m-5"
								@click:append="passShow = !passShow"
								id="password"
								name="password"
							></v-text-field>

							<v-checkbox
								v-model="form.remember"
								name="remember"
								label="Remember me"
								class="m-5"
							></v-checkbox>

							<v-btn color="primary" type="submit" block
								>Login</v-btn
							>
						</form>
					</v-col>
				</v-row>
			</v-container>
		</v-main>
	</v-app>
</template>

<script>
import ApplicationLogo from '@/Jetstream/ApplicationLogo'
import ApplicationLogoBanner from '@/Components/ApplicationLogoBanner'
import ApplicationLogoSmall from '@/Components/ApplicationLogoSmall'

export default {
	components: {
		ApplicationLogo,
		ApplicationLogoBanner,
		ApplicationLogoSmall
	},

	props: {
		errors: Object
	},

	data: () => ({
		form: null,
		valid: true,
		passShow: false,
		emailRules: [
			v => !!v || 'E-mail is required',
			v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
		],
		passRules: [v => !!v || 'Password is required'],
		csrf: document
			.querySelector('meta[name="csrf-token"]')
			.getAttribute('content')
	}),
	created() {
		this.$vuetify.theme.dark = false
		this.form = this.$inertia.form({
			email: null,
			password: null,
			remember: false,
			_token: this.csrf
		})
		console.log(this.form, this.errors)
	},
	watch: {
		form() {}
	},
	methods: {
		submit() {
			this.$inertia.post(route('login'), this.form)
		},
		validate() {
			this.$refs.form.validate()
		}
	}
}
</script>

<style scoped>
#logo {
	height: 100px;
}
</style>
