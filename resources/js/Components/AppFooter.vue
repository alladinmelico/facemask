<template>
	<v-footer padless>
		<v-card flat tile width="100%" class="text-center">
			<v-card-text>
				<v-btn v-for="link in links" :key="link.url" class="mx-4" icon>
					<a :href="link.url">
						<v-icon size="24px">
							{{ link.icon }}
						</v-icon>
					</a>
				</v-btn>
			</v-card-text>

			<v-divider></v-divider>

			<v-card-text>
				<p>Developed by Alladin Melico</p>
				<p>
					{{ new Date().getFullYear() }} — <strong>facemask</strong>
				</p>
			</v-card-text>
		</v-card>
	</v-footer>
</template>

<script>
export default {
	data: () => ({
		links: [
			{
				url: 'https://www.facebook.com/melico.alladin',
				icon: 'mdi-facebook'
			},
			{ url: 'https://twitter.com/iDontHaveALamp', icon: 'mdi-twitter' },
			{ url: 'https://linkedin.com/in/alladin-m', icon: 'mdi-linkedin' },
			{
				url: 'https://www.instagram.com/melico.alladin/',
				icon: 'mdi-instagram'
			},
			{ url: 'https://dev.to/alladinmelico', icon: 'mdi-dev-to' }
		]
	})
}
</script>
