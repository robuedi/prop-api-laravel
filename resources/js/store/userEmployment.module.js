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
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/employments`, data).then((response) => {
                commit('SET_EMPLOYMENT', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_EMPLOYMENT', [])
                throw err
            })
        },
        async getCurrentUserEmployment ({ dispatch, commit }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/employments`).then((response) => {
                commit('SET_EMPLOYMENT', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_EMPLOYMENT', [])
                throw err
            })
        }
    }
}
