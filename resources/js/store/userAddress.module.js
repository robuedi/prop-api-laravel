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
            return axios.post('/api/v1/user-address', data).then((response) => {
                commit('SET_USER_ADDRESS', response.data.data)
            }).catch(() => {
                commit('SET_USER_ADDRESS', [])
            })
        },
        async getCurrentUserAddress ({ dispatch, commit }) {
            return axios.get('/api/v1/user-address/current-user').then((response) => {
                commit('SET_USER_ADDRESS', response.data.data)
            }).catch(() => {
                commit('SET_USER_ADDRESS', [])
            })
        }
    }
}
