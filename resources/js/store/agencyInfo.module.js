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
            let userId = this.state.auth.user.id
            return axios.post(`/api/v1/users/${userId}/agencies`, data).then((response) => {
                commit('SET_AGENCY', response.data.data)
            }).catch(() => {
                commit('SET_AGENCY', [])
            })
        },
        async getCurrentUserAgency ({ dispatch, commit }) {
            let userId = this.state.auth.user.id
            return axios.get(`/api/v1/users/${userId}/agencies`).then((response) => {
                commit('SET_AGENCY', response.data.data)
            }).catch(() => {
                commit('SET_AGENCY', [])
            })
        }
    }
}
