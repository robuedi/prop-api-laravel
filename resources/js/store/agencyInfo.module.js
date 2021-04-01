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
            return axios.post('/api/v1/agencies', data).then((response) => {
                commit('SET_AGENCY', response.data.data)
            }).catch(() => {
                commit('SET_AGENCY', [])
            })
        },
        async getCurrentUserAgency ({ dispatch, commit }) {
            return axios.get('/api/v1/agencies/current-user').then((response) => {
                commit('SET_AGENCY', response.data.data)
            }).catch(() => {
                commit('SET_AGENCY', [])
            })
        }
    }
}
