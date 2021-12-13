import axios from 'axios'

const disastersModule = {
    state: () => ({
		lines: 5,
        page: 1,
        disasters: [],
        isDisastersLoading: true,
        category: 'All',
        isDisastersSaving: true,
		messages: [],
    }),
    getters: {
        currentDisasters(state, getters) {
            const from = (state.page - 1) * state.lines
            const to = state.page * state.lines

            return getters.filteredDisasters.slice(from, to)
        },
        filteredDisasters(state) {
            const filtered = []

            if (state.category === 'All') {
                return state.disasters
            }
    
            state.disasters.forEach(disaster => {
                disaster.categories.forEach(category => {
                    if (category.title === state.category) {
                        filtered.push(disaster)
                    }
                })
            })

            return filtered
        }
    },
    mutations: {
        setDisasters(state, disasters) {
            state.disasters = disasters
        },
        setLoading(state, bool) {
            state.isDisastersLoading = bool
        },
		setDisastersSaving(state, bool) {
			state.isDisastersSaving = bool
		},
        setPage(state, page) {
            state.page = page
        },
		nextPage(state) {
			state.page += 1
		},
		prevPage(state) {
            if (state.page - 1 <= 0) return
			state.page -= 1
		},
        addMessage(state, message) {
            state.messages.push(message)
        },
		setLines(state, lines) {
			state.lines = parseInt(lines.target.value)
		},
		setCategory(state, category) {
			state.category = category.target.value
		}
    },
    actions: {
        async postDisasters({state, commit}) {
            try {
				commit('setDisastersSaving', true)
				const response = await axios({
					method: 'post',
					url: 'http://localhost:8000/api/events',
					data: {
						events: state.disasters
					}
				})
      
              	commit('addMessage', response.data.message)
				commit('setDisastersSaving', false)
				console.log('Events have been saved to database!')
            } catch (e) {
                commit('addMessage', e.message)
            } finally {
				commit('setDisastersSaving', false)
            }
          },
        async fetchDisasters({state, commit, dispatch}) {
            try {
                commit('setLoading', true)
                const response = await axios.get(`https://eonet.gsfc.nasa.gov/api/v2.1/events`)
                commit('setDisasters', response.data.events)
				dispatch('postDisasters')
            } catch (e) {
                commit('addMessage', e.message)
            } finally {
                commit('setLoading', false)
            }
        }
    },
    namespaced: true,
}

export default disastersModule