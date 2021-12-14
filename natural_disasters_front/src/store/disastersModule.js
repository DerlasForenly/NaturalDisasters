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
        setLines({dispatch, commit}, event) {
			commit('setLines', event)
            dispatch('fetchDisasters')
		},
        setCategory({dispatch, commit}, event) {
			commit('setCategory', event)
            dispatch('fetchDisasters')
		},
        nextPage({dispatch, commit}) {
			commit('nextPage')
            dispatch('fetchDisasters')
		},
		prevPage({dispatch, commit}) {
            commit('prevPage')
            dispatch('fetchDisasters')
		},
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
                console.log(state.category)
                commit('setLoading', true)
                const response = await axios.get(`http://localhost:8000/api/events?page=${state.page}&limit=${state.lines}&category=${state.category}`)
                commit('setDisasters', response.data.events.data)
            } catch (e) {
                commit('addMessage', e.message)
            } finally {
                commit('setLoading', false)
            }
        },
        async fetchFilteredDisasters({state, commit}) {

        },
    },
    namespaced: true,
}

export default disastersModule