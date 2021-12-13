<template>
	<div class="row">
		<button @click="prevPage()">Prev</button>
		<label>{{ $store.state.disasters.page }}</label>
		<button @click="nextPage()">Next</button>
	</div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'

export default {
  name: 'Pagination',
	methods: {
		...mapMutations({
			nextPage: 'disasters/nextPage',
			prevPage: 'disasters/prevPage',
		})
	},
	computed: {
		...mapState({
      page: state => state.disasters.page,
    }),
	}
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