export default {
    namespaced: true,

    state: {
        countries: [],
    },

    getters: {
        countries (state) {
            return state.countries
        }
    },

    mutations: {
        SET_COUNTRIES (state, value) {
            state.countries = value
        }
    },

    actions: {
        async getCountries ({ commit }) {
            if(this.state.countries.length > 0)
            {
                return
            }

            await axios.get('/api/v1/countries?fields=id,name').then((response) => {
                commit('SET_COUNTRIES', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_COUNTRIES', [])
                throw err
            })
        }
    }
}
