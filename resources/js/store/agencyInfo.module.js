export default {
    namespaced: true,

    state: {
        agency: [],
    },

    getters: {
        agency (state) {
            return state.agency
        }
    },

    mutations: {
        SET_AGENCY (state, value) {
            state.agency = value
        }
    },

    actions: {
        async setAgency ({ dispatch, commit }, data) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/agencies`, data).then((response) => {
                commit('SET_AGENCY', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_AGENCY', [])
                throw err
            })
        },
        async getCurrentUserAgency ({ dispatch, commit }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/agencies`).then((response) => {
                commit('SET_AGENCY', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_AGENCY', [])
                throw err
            })
        }
    }
}
