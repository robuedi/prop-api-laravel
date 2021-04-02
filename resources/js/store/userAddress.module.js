export default {
    namespaced: true,

    state: {
        userAddress: [],
    },

    getters: {
        userAddress (state) {
            return state.userAddress
        }
    },

    mutations: {
        SET_USER_ADDRESS (state, value) {
            state.userAddress = value
        }
    },

    actions: {
        async setUserAddress ({ dispatch, commit }, data) {
            let userId = this.state.auth.user.id
            return axios.post(`/api/v1/users/${userId}/addresses`, data).then((response) => {
                commit('SET_USER_ADDRESS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_USER_ADDRESS', [])
                throw err
            })
        },
        async getCurrentUserAddress ({ dispatch, commit }) {
            let userId = this.state.auth.user.id
            return axios.get(`/api/v1/users/${userId}/addresses`).then((response) => {
                commit('SET_USER_ADDRESS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_USER_ADDRESS', [])
                throw err
            })
        }
    }
}
