<template>
	<div class="column">
		<div v-for="message in messages" :key="message">{{ message }}</div>
	</div>
</template>

<script>
export default {
  name: 'Messages',
	props: {
		messages: {
			type: Array,
			required: true,
		}
	},
}
</script>

<style scoped>
.column {
  margin-left: 15px;
  margin-top: 15px;
  width: fit-content;
}
</style>