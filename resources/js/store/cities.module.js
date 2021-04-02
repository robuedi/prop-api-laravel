export default {
    namespaced: true,

    state: {
        cities: [],
    },

    getters: {
        cities (state) {
            return state.cities
        }
    },

    mutations: {
        SET_CITIES (state, value) {
            state.cities = value
        }
    },

    actions: {
        async getCities ({ commit }) {
            if(this.state.cities.length > 0)
            {
                return
            }

            await axios.get('/api/v1/cities?fields=id,country_id,name').then((response) => {
                commit('SET_CITIES', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_CITIES', [])
                throw err
            })
        },
    }
}
