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
        async setAnnualSalary ({ dispatch, commit, rootGetters }, amount) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/annual-salaries`, amount).then((response) => {
                commit('SET_ANNUAL_SALARY', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_ANNUAL_SALARY', [])
                throw err
            })
        },
        async getCurrentUserAnnualSalary ({ dispatch, commit, rootGetters }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/annual-salaries`).then((response) => {
                commit('SET_ANNUAL_SALARY', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_ANNUAL_SALARY', [])
                throw err
            })
        }
    }
}
