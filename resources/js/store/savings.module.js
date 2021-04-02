export default {
    namespaced: true,

    state: {
        savings: [],
    },

    getters: {
        savings (state) {
            return state.savings
        }
    },

    mutations: {
        SET_SAVINGS (state, value) {
            state.savings = value
        }
    },

    actions: {
        async setSavings ({ dispatch, commit, rootGetters }, amount) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/savings`, amount).then((response) => {
                commit('SET_SAVINGS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_SAVINGS', [])
                throw err
            })
        },
        async getCurrentUserSavings ({ commit, rootGetters }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/savings`).then((response) => {
                commit('SET_SAVINGS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_SAVINGS', [])
                throw err
            })
        }
    }
}
