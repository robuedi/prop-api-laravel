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
        async getCities ({ dispatch, commit }) {
            if(this.state.cities.length > 0)
            {
                return
            }

            await axios.get('/api/v1/cities?fields=id,country_id,name').then((response) => {
                commit('SET_CITIES', response.data.data)
            }).catch(() => {
                commit('SET_CITIES', [])
            })
        }
    }
}