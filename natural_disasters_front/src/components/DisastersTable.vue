<template>
	<div>
		<table v-if="disasters.length !== 0">
			<tr>
				<th>Title</th>
				<th>Date and time</th>
				<th>Reference</th>
			</tr>
			<disaster-item 
				v-for="disaster in disasters" 
				:key="disaster.id" 
				:disaster="disaster">
			</disaster-item>
		</table>
		<div v-else>Table is empty</div>
	</div>
</template>

<script>
import DisasterItem from './DisasterItem.vue'

export default {
  components: { DisasterItem },
	props: {
		disasters: {
			type: Array,
			required: true
		}
	},
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
	background: whitesmoke;
}

td {
	color: gray;
}
</style>