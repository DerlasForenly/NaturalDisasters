<template>
	<table>
		<tr>
			<th>Title</th>
			<th>Date and time</th>
			<th>Reference</th>
		</tr>
		<tr>
			<td>Some shit</td>
			<td>Yesterday</td>
			<td>http://localhost:8080</td>
		</tr>
	</table>
</template>

<script>
export default {
  name: 'DisastersTable'
}
</script>

<style scoped>
table {
	width: 100%;
	border: 1px solid lightgray;
	border-collapse: collapse;
}

th, td {
	border: 1px solid lightgray;
	padding: 5px;
}

th {
	color: black;
}

td {
	color: gray;
}
</style>