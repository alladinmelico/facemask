<template>
	<div class="text-center ma-5">
		<v-pagination v-model="page" :length="links.length"></v-pagination>
	</div>
</template>

<script>
export default {
	props: {
		links: Array
	},
	data() {
		return {
			page: 1
		}
	},
	watch: {
		page() {
			this.$inertia.visit(this.links[this.page - 1].url, {
				preserveState: true
			})
		},
		links() {
			this.links.forEach(link => {
				if (link.active) this.page = link.label
			})
		}
	}
}
</script>
