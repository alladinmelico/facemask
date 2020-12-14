<template>
	<app-layout>
		<div>
			<inertia-link :href="$route('user.create')"
				>Create User</inertia-link
			>
		</div>
	</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
	components: {
		AppLayout
	}
	// props: {
	// 	user: Object
	// }
}
</script>

<style></style>
