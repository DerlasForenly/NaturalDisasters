<template>
	<div class="row">
		<button>Left</button>
		<label>?</label>
		<button>Right</button>
	</div>
</template>

<script>
export default {
  name: 'Pagination'
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