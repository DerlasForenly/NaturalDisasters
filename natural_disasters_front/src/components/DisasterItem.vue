<template>
	<tr>
		<td>{{ disaster.title }}</td>
		<td>{{ disaster.geometries[0].date }}</td>
		<td>{{ "some url" }}</td>
	</tr>
</template>

<script>
export default {
	props: {
		disaster: {
			type: Object,
			required: true
		}
	},
  name: 'DisasterItem'
}
</script>

<style scoped>
td {
	border: 1px solid lightgray;
	padding: 5px;
	color: gray;
}
</style>