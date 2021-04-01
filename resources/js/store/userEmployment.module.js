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
            return axios.post('/api/v1/user-employment', data).then((response) => {
                commit('SET_EMPLOYMENT', response.data.data)
            }).catch(() => {
                commit('SET_EMPLOYMENT', [])
            })
        },
        async getCurrentUserEmployment ({ dispatch, commit }) {
            return axios.get('/api/v1/user-employment/current-user').then((response) => {
                commit('SET_EMPLOYMENT', response.data.data)
            }).catch(() => {
                commit('SET_EMPLOYMENT', [])
            })
        }
    }
}
