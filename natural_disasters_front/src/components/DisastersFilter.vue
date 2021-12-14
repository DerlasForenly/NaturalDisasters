<template>
	<form @event.prevent class="row">
		<div class="row">
			<label>Category:</label>
			<select @change="setCategory">
				<option>All</option>
				<option v-for="category in categories" :key="category.id">{{ category.title }}</option>
			</select>
		</div>
		<div class="row">
			<label>Lines per page:</label>
			<select @change="setLines">
				<option>5</option>
				<option>10</option>
				<option>20</option>
			</select>
		</div>
	</form>
</template>

<script>
import { mapActions, mapState } from 'vuex'

export default {
  name: 'DisastersFilter',
	methods: {
		...mapActions({
			setLines: 'disasters/setLines',
			setCategory: 'disasters/setCategory',
			fetchCategories: 'categories/fetchCategories'
		}),
  },
	computed: {
		...mapState({
			categories: state => state.categories.categories
		})
	},
	mounted() {
		this.fetchCategories()
	},
}
</script>

<style scoped>
.row {
	align-items: center;
	height: fit-content;
	margin: 5px;
	display: flex;
	flex-direction: row;
}

label {
	padding: 5px;
}

select, button {
	background: whitesmoke;
	border-radius: 5px;
	padding: 5px;
	border: none;
}
</style>