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
            let userId = this.state.auth.user.id
            return axios.post(`/api/v1/users/${userId}/rents`, amount).then((response) => {
                commit('SET_RENT', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_RENT', [])
                throw err
            })
        },
        async getCurrentUserRent ({ dispatch, commit }) {
            let userId = this.state.auth.user.id
            return axios.get(`/api/v1/users/${userId}/rents`).then((response) => {
                commit('SET_RENT', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_RENT', [])
                throw err
            })
        }
    }
}
