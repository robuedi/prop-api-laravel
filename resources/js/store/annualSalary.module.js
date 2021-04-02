export default {
    namespaced: true,

    state: {
        annualSalary: [],
    },

    getters: {
        annualSalary (state) {
            return state.annualSalary
        }
    },

    mutations: {
        SET_ANNUAL_SALARY (state, value) {
            state.annualSalary = value
        }
    },

    actions: {
        async setAnnualSalary ({ dispatch, commit }, amount) {
            let userId = this.context.rootState.auth.user.id
            return axios.post(`/api/v1/users/${userId}/annual-salaries`, amount).then((response) => {
                commit('SET_ANNUAL_SALARY', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_ANNUAL_SALARY', [])
                throw err
            })
        },
        async getCurrentUserAnnualSalary ({ dispatch, commit }) {
            let userId = this.context.rootState.auth.user.id
            return axios.get(`/api/v1/users/${userId}/annual-salaries`).then((response) => {
                commit('SET_ANNUAL_SALARY', response.data.data)
                return response
            }).catch(() => {
                commit('SET_ANNUAL_SALARY', [])
                throw err
            })
        }
    }
}
