<template>
	<div>
		<inertia-link href="$route('user.create')">Create User</inertia-link>
		<div v-for="user in users" class="" :key="user.id"></div>
	</div>
</template>

<script>
import Layout from '@/Layouts/Layout'

export default {
	layout: Layout,
	props: {
		users: Array
	}
}
</script>

<style></style>
