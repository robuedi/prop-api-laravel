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
            return axios.post('/api/v1/annual-salaries', amount).then((response) => {
                commit('SET_ANNUAL_SALARY', response.data.data)
            }).catch(() => {
                commit('SET_ANNUAL_SALARY', [])
            })
        },
        async getCurrentUserAnnualSalary ({ dispatch, commit }) {
            return axios.get('/api/v1/annual-salaries/current-user').then((response) => {
                commit('SET_ANNUAL_SALARY', response.data.data)
            }).catch(() => {
                commit('SET_ANNUAL_SALARY', [])
            })
        }
    }
}
