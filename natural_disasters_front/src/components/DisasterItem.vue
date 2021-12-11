<template>
	<tr>
		<td>{{ disaster.title }}</td>
		<td>{{ disaster.geometries[0].date }}</td>
		<td><a href="http://localhost:8080">http://localhost:8080</a></td>
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

tr:hover td {
	color: black;
}

tr:hover td a {
	color: black;
}

a {
	text-decoration: none;
	color: gray
}
</style>