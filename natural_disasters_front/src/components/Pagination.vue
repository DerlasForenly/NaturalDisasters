<template>
	<div class="row">
		<button @click="prev">Prev</button>
		<label>{{ page }}</label>
		<button @click="next">Next</button>
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
	margin-top: 10px;
}

label, button {
	color: gray;
	padding: 5px;
	border: none;
	background: none;
}

label {
	color: black;
}

button:hover {
	color: black;
}
</style>