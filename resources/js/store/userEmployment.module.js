export default {
    namespaced: true,

    state: {
        employment: [],
    },

    getters: {
        employment (state) {
            return state.employment
        }
    },

    mutations: {
        SET_EMPLOYMENT (state, value) {
            state.employment = value
        }
    },

    actions: {
        async setEmployment ({ dispatch, commit }, data) {
            let userId = this.state.auth.user.id
            return axios.post(`/api/v1/users/${userId}/employments`, data).then((response) => {
                commit('SET_EMPLOYMENT', response.data.data)
            }).catch(() => {
                commit('SET_EMPLOYMENT', [])
            })
        },
        async getCurrentUserEmployment ({ dispatch, commit }) {
            let userId = this.state.auth.user.id
            return axios.get(`/api/v1/users/${userId}/employments`).then((response) => {
                commit('SET_EMPLOYMENT', response.data.data)
            }).catch(() => {
                commit('SET_EMPLOYMENT', [])
            })
        }
    }
}
