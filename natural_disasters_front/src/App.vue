<template>
  <div id="app">
    <DisastersFilter/>
    <DisastersTable/>
    <Pagination/>
  </div>
</template>

<script>
import DisastersFilter from "./components/Filter.vue"
import DisastersTable from "./components/DisastersTable.vue"
import Pagination from "./components/Pagination.vue"

export default {
  name: 'App',
  components: {
    DisastersFilter,
    DisastersTable,
    Pagination
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  padding: 15px;
}
</style>
