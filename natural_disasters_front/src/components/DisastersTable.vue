<template>
	<div>
		<table v-if="disasters.length !== 0">
			<tbody>
				<tr>
					<th>Title</th>
					<th>Date and time</th>
					<th>On Google Maps</th>
				</tr>
				<disaster-item 
					v-for="disaster in disasters" 
					:key="disaster.id" 
					:disaster="disaster">
				</disaster-item>
			</tbody>
		</table>
		<div v-else>Table is empty</div>
	</div>
</template>

<script>
import DisasterItem from './DisasterItem.vue'

export default {
  components: { DisasterItem },
  name: 'DisastersTable',
	props: {
		disasters: {
			type: Object,
			required: true
		}
	}
}
</script>

<style scoped>
table {
	width: 100%;
	border: 1px solid lightgray;
	border-collapse: collapse;
}

th {
	border: 1px solid lightgray;
	padding: 5px;
	color: black;
	background: whitesmoke;
}
</style>