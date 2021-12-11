<template>
  <div id="app">
    <DisastersFilter 
      @change-category="changeCategory"
      @change-lines="changeLines"
      v-if="!isDisastersLoading"
    />
    <DisastersTable 
      :disasters="currentDisasters" 
      v-if="!isDisastersLoading"
    />
    <div v-else>Loading</div>
    <Pagination
      :page="currentPage"
      @change-page="changePage"
    />
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
      currentDisasters: [],
      disasters: [],
      filteredDisasters: [],
      selectedLines: 5,
    }
  },
  methods: {
    updateCurrentDisasters() {
      const from = (this.currentPage - 1) * this.selectedLines
      const to = this.currentPage * this.selectedLines + 1
      
      this.currentDisasters = this.filteredDisasters.slice(from, to)
    },
    updateFilteredDisasters() {
      if (this.selectedCategory === 'All') {
        this.filteredDisasters = this.disasters
        return
      }

      this.filteredDisasters = []

      this.disasters.forEach(disaster => {
        disaster.categories.forEach(category => {
          if (category.title === this.selectedCategory) {
            this.filteredDisasters.push(disaster)
          }
        })
      })
    },
    changeCategory(selectedCategory) {
      this.selectedCategory = selectedCategory
      this.updateFilteredDisasters()
      this.updateCurrentDisasters()
    },
    changeLines(lines) {
      this.selectedLines = lines
      this.updateCurrentDisasters()
    },
    changePage(page) {
      this.currentPage = page
      this.updateCurrentDisasters()
    },
    async postDisasters() {
      try {
        const response = await axios({
          method: 'post',
          url: 'http://localhost:8000/api/events',
          data: this.disasters
        })

        console.log(response.data)
      } catch (e) {
        console.log(e)
      }
    },
    async fetchDisasters() {
      try {
        this.isDisastersLoading = true

        const response = await axios.get(`https://eonet.gsfc.nasa.gov/api/v2.1/events`)
        const events = response.data.events
        console.log(events)

        this.disasters = events
        this.filteredDisasters = events
        this.isDisastersLoading = false
        
        this.updateCurrentDisasters()
        this.postDisasters()
      } catch (e) {
        console.log(e)
      } finally {
        this.isDisastersLoading = false
      }
    }
  },
  mounted() {
    console.log('App has been mounted!')
    this.fetchDisasters()
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
  box-shadow: 1px 1px 2px 2px lightgray;
  border-radius: 15px;
}
</style>
