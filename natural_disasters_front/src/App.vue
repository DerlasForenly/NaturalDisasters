<template>
  <div>
    <h1>Earth Observatory Natural Event Tracker</h1>
    <disasters-filter/>
    <div v-if="!isDisastersLoading">
      <disasters-table :disasters="currentDisasters"/>
      <pagination/>
      <messages v-if="!isDisastersSaving" :messages="messages"></messages>
    </div>
    <img v-else src="./assets/loading.gif" alt="loading">
  </div>
</template>

<script>
import DisastersFilter from "./components/DisastersFilter.vue"
import DisastersTable from "./components/DisastersTable.vue"
import Pagination from "./components/Pagination.vue"
import Messages from "./components/Messages.vue"
import { mapGetters, mapState, mapActions, mapMutations } from 'vuex'

export default {
  name: 'App',
  components: {
    DisastersFilter,
    DisastersTable,
    Pagination,
    Messages,
  },
  methods: {
		...mapActions({
      fetchDisasters: 'disasters/fetchDisasters',
      postDisasters: 'disasters/postDisasters'
    }),
		...mapMutations({
      setPage: 'disasters/setPage',
      setLoading: 'disasters/setLoading'
    }),
  },
  mounted() {
    console.log('App has been mounted!')
    this.fetchDisasters()
  },
  computed: {
    ...mapState({
      page: state => state.disasters.page,
      isDisastersLoading: state => state.disasters.isDisastersLoading,
      disasters: state => state.disasters.disasters,
      isDisastersSaving: state => state.disasters.isDisastersSaving,
      messages: state => state.disasters.messages,
    }),
    ...mapGetters({
			currentDisasters: 'disasters/currentDisasters'
		}),
  }
}
</script>

<style>
img {
  height: 130px;
  width: 130px;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  padding: 15px;
  box-shadow: 1px 1px 2px 2px lightgray;
  border-radius: 15px;
}

h1 {
  padding: 10px;
  border-bottom: 1px solid lightgray;
}
</style>
