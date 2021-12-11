<template>
	<div class="row">
		<label v-if="selectName">{{ selectName }}</label>
		<select v-model="selectedOption" @change="changeOption">
			<option selected>All</option>
			<option v-for="option in options" :key="option.id">{{ option.value }}</option>
		</select>
	</div>
</template>

<script>
export default {
	name: "MySelect",
	props: {
		selectName: {},
		options: {
			type: Array,
			default: () => []
		}
	},
	data() {
		return {
			selectedOption: null,
		}
	},
	methods: {
		changeOption() {
			this.$emit('change-option', this.selectedOption)
		}
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