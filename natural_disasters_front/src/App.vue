<template>
  <div id="app">
    <DisastersFilter 
      @change-category="changeCategory"
      @change-lines="changeLines"
    />
    <DisastersTable :disasters="disasters" v-if="!isDisastersLoading"/>
    <div v-else>Loading</div>
    <Pagination :page="currentPage" @change-page="changePage"/>
  </div>
</template>

<script>
import axios from 'axios'
import DisastersFilter from "./components/DisastersFilter.vue"
import DisastersTable from "./components/DisastersTable.vue"
import Pagination from "./components/Pagination.vue"

export default {
  name: 'App',
  components: {
    DisastersFilter,
    DisastersTable,
    Pagination
  },
  data() {
    return {
      isDisastersLoading: true,
      currentPage: 1,
      disasters: [],
      selectedLines: 5,
      selectedCategory: 'All'
    }
  },
  methods: {
    changeCategory(selectedCategory) {
      this.selectedCategory = selectedCategory
      this.fetchDisasters(this.selectedLines, this.selectedCategory)
    },
    changeLines(lines) {
      this.selectedLines = lines
      this.fetchDisasters(this.selectedLines, this.selectedCategory)
    },
    changePage(page) {
      this.currentPage = page
      this.fetchDisasters(this.selectedLines, this.selectedCategory)
    },
    async fetchDisasters(lines, category) {
      try {
        if (category !== "All") return
        this.isDisastersLoading = true
        const response = await axios.get(`https://eonet.gsfc.nasa.gov/api/v2.1/events?limit=${lines}`)
        console.log(response.data.events)
        this.disasters = response.data.events,
        this.isDisastersLoading = false
      } catch (e) {
        console.log(e)
      } finally {
        this.isDisastersLoading = false
      }
    }
  },
  mounted() {
    console.log('App has been mounted!')
    this.fetchDisasters(this.selectedLines, this.selectedCategory)
  },
  watch: {
    currentPage(newValue) {
      console.log(newValue)
    }
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
