<template>
	<div class="row">
		<label>Type:</label>
		<select id="type">
			<option>Rain</option>
			<option>Shitpost</option>
		</select>
	</div>
</template>

<script>
export default {
  name: 'DisastersFilter'
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