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
        async setUserAddress ({ dispatch, commit, rootGetters }, data) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/addresses`, data).then((response) => {
                commit('SET_USER_ADDRESS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_USER_ADDRESS', [])
                throw err
            })
        },
        async getCurrentUserAddress ({ commit, rootGetters }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/addresses`).then((response) => {
                commit('SET_USER_ADDRESS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_USER_ADDRESS', [])
                throw err
            })
        }
    }
}
