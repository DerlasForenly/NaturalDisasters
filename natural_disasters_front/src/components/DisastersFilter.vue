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
import axios from 'axios'
import { mapMutations } from 'vuex'

export default {
  name: 'DisastersFilter',
	data() {
		return {
			categories: []
		}
	},
	methods: {
		...mapMutations({
			setLines: 'disasters/setLines',
			setCategory: 'disasters/setCategory',
		}),
		async fetchCategories() {
			try {
				const response = await axios.get(`https://eonet.gsfc.nasa.gov/api/v2.1/categories`)
				this.categories = response.data.categories
			} catch (e) {
				console.log(e)
			}
		}
  },
	mounted() {
		this.fetchCategories()
	},
}
</script>

<style scoped>
.row {
	margin: 5px;
	display: flex;
	flex-direction: row;
}

label {
	padding: 5px;
}

select {
	background: whitesmoke;
	border-radius: 5px;
	padding: 5px;
	border: none;
}
</style>