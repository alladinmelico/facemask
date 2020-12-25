<template>
	<app-layout>
		<div>
			<inertia-link :href="$route('user.create')"
				>Create User</inertia-link
			>
			<div v-for="user in users" class="bg-red-200" :key="user.id">
				<img
					:src="user.profile_photo_url"
					:alt="user.name"
					class="w-12 h-12 rounded-full"
				/>
			</div>
		</div>
	</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
	components: {
		AppLayout
	},
	props: {
		users: Array
	}
}
</script>

<style></style>
