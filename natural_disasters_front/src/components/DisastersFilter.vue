<template>
	<form @event.prevent class="row">
		<div class="row">
			<label>Category:</label>
			<select @change="changeCategory">
				<option>All</option>
				<option v-for="category in categories" :key="category.id">{{ category.title }}</option>
			</select>
		</div>
		<div class="row">
			<label>Lines per page:</label>
			<select @change="changeLines" :options="linesPerPage">
				<option v-for="lines in linesPerPage" :key="lines">{{ lines }}</option>
			</select>
		</div>
	</form>
</template>

<script>
import axios from 'axios'

export default {
  name: 'DisastersFilter',
	data() {
		return {
			categories: [],
			linesPerPage: [5, 10, 20]
		}
	},
	methods: {
    changeCategory(event) {
      this.$emit('change-category', event.target.value)
    },
		changeLines(event) {
      this.$emit('change-lines', event.target.value)
    },
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