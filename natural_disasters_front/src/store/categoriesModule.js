import axios from 'axios'

const categoriesModule = {
    state: () => ({
		categories: []
    }),
    mutations: {
        setCategories(state, categories) {
            state.categories = categories
        },
    },
    actions: {
        async fetchCategories({state, commit}) {
            try {
                const response = await axios.get(`http://localhost:8000/api/categories`)
                commit('setCategories', response.data)
            } catch (e) {
                console.log(e)
            }
        },
    },
    namespaced: true,
}

export default categoriesModule