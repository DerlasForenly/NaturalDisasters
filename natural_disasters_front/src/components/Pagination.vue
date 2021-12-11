<template>
	<div class="row">
		<button @click="prev">Left</button>
		<label>{{ page }}</label>
		<button @click="next">Right</button>
	</div>
</template>

<script>
export default {
  name: 'Pagination',
  props: {
		page: {
			type: Number,
			required: true
		}
  },
	methods: {
		prev() {
			if (this.page - 1 <= 0) return 
			this.$emit('change-page', this.page - 1)
		},
		next() {
			this.$emit('change-page', this.page + 1)
		}
	},
}
</script>

<style scoped>
.row {
	width: fit-content;
	margin: auto;
	display: flex;
	flex-direction: row;
}

label, button {
	padding: 5px;
	border: none;
	background: none;
}
</style>