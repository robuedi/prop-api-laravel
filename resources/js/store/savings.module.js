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
            let userId = this.context.rootState.auth.user.id
            return axios.post(`/api/v1/users/${userId}/savings`, amount).then((response) => {
                commit('SET_SAVINGS', response.data.data)
            }).catch(() => {
                commit('SET_SAVINGS', [])
            })
        },
        async getCurrentUserSavings ({ dispatch, commit }) {
            let userId = this.context.rootState.auth.user.id
            return axios.get(`/api/v1/users/${userId}/savings`).then((response) => {
                commit('SET_SAVINGS', response.data.data)
            }).catch(() => {
                commit('SET_SAVINGS', [])
            })
        }
    }
}
