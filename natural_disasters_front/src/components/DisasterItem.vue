<template>
	<tr>
		<td>{{ disaster.title }}</td>
		<td>{{ disaster.geometries[0].date }}</td>
		<td><a :href="href" target="_blank">{{ href }}</a></td>
	</tr>
</template>

<script>
export default {
	data() {
		return {
			href: `https://www.google.com/maps/search/?api=1&query=${this.getLat()},${this.getLng()}`
		}
	},
	props: {
		disaster: {
			type: Object,
			required: true
		}
	},
	methods: {
		getLng() {
			return this.disaster.geometries[0].coordinates[0];
		},
		getLat() {
			return this.disaster.geometries[0].coordinates[1]
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