<template>
	<form @event.prevent class="row">
		<my-select 
			:options="disastersCategories" 
			@change-option="changeCategory" 
			:selectName="'Category'">
		</my-select>
		<div class="row">
			<label>Lines per page:</label>
			<select @change="changeLines" :options="linesPerPage">
				<option v-for="lines in linesPerPage" :key="lines">{{ lines }}</option>
			</select>
		</div>
	</form>
</template>

<script>
import MySelect from './UI/MySelect.vue'

export default {
  components: { MySelect },
  name: 'DisastersFilter',
	data() {
		return {
			disastersCategories: [
				{
					id: 1,
					value: "Rain"
				},
				{
					id: 2,
					value: 'Shitpost'
				}
			],
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
				console.log('hello')
			} catch (e) {
				console.log(e)
			} finally {
				console.log('finally')
			}
		}
  },
	mounted() {
		
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