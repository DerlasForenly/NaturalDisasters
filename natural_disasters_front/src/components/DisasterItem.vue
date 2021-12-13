<template>
	<tr>
		<td>{{ disaster.title }}</td>
		<td>{{ getDate }}</td>
		<td><a :href="getUrl()" target="_blank">{{ getUrl() }}</a></td>
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
	methods: {
		getUrl() {
			return `https://www.google.com/maps/search/?api=1&query=${this.getLat},${this.getLng}`
		}
	},
	computed: {
		getLng() {
			return this.disaster.geometries[0].coordinates[0]
		},
		getLat() {
			return this.disaster.geometries[0].coordinates[1]
		},
		getDate() {
			const date = new Date(this.disaster.geometries[0].date)
			return date.toGMTString()
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