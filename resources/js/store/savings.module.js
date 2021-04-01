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
        async setSavings ({ dispatch, commit }, amount) {
            return axios.post('/api/v1/user-savings', amount).then((response) => {
                commit('SET_SAVINGS', response.data.data)
            }).catch(() => {
                commit('SET_SAVINGS', [])
            })
        },
        async getCurrentUserSavings ({ dispatch, commit }) {
            return axios.get('/api/v1/user-savings/current-user').then((response) => {
                commit('SET_SAVINGS', response.data.data)
            }).catch(() => {
                commit('SET_SAVINGS', [])
            })
        }
    }
}
