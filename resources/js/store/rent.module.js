export default {
    namespaced: true,

    state: {
        rent: [],
    },

    getters: {
        rent (state) {
            return state.rent
        }
    },

    mutations: {
        SET_RENT (state, value) {
            state.rent = value
        }
    },

    actions: {
        async setRent ({ dispatch, commit }, amount) {
            return axios.post('/api/v1/user-rent', amount).then((response) => {
                commit('SET_RENT', response.data.data)
            }).catch(() => {
                commit('SET_RENT', [])
            })
        },
        async getCurrentUserRent ({ dispatch, commit }) {
            return axios.get('/api/v1/user-rent/current-user').then((response) => {
                commit('SET_RENT', response.data.data)
            }).catch(() => {
                commit('SET_RENT', [])
            })
        }
    }
}
