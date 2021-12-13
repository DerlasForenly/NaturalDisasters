<template>
	<tr>
		<td>{{ disaster.title }}</td>
		<td>
			<select @change="changeSelect">
				<option :selected="selected" :value="0">{{ getDate(disaster.geometries[0].date) }}</option>
				<option 
					v-for="geometry in disaster.geometries.slice(1)" 
					:key="disaster.geometries.indexOf(geometry)" 
					:value="disaster.geometries.indexOf(geometry)"
				>{{ getDate(geometry.date) }}</option>
			</select>
		</td>
		<td><a :href="getUrl()" target="_blank">{{ getUrl() }}</a></td>
	</tr>
</template>

<script>
export default {
	data() {
		return {
			selected: 0
		}
	},
	props: {
		disaster: {
			type: Object,
			required: true
		}
	},
	methods: {
		getUrl() {
			const lat = this.getLat
			const lng = this.getLng

			return `https://www.google.com/maps/search/?api=1&query=${lat},${lng}`
		},
		getDate(date) {
			const formatedDate = new Date(date)
			return formatedDate.toGMTString()
		},
		changeSelect(event) {
			this.selected = event.target.value
		},
	},
	computed: {
		getLng() {
			return this.disaster.geometries[this.selected].coordinates[0]
		},
		getLat() {
			return this.disaster.geometries[this.selected].coordinates[1]
		},
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

tr:hover select {
	color: black;
}

tr:hover td a {
	color: black;
}

a {
	text-decoration: none;
	color: gray
}

select {
	background: whitesmoke;
	border-radius: 5px;
	padding: 7px;
	border: none;
	width: 100%;
	color: gray;
	outline: none;
}

</style>