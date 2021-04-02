export default {
    namespaced: true,

    state: {
        agencyAddress: [],
    },

    getters: {
        agencyAddress (state) {
            return state.agencyAddress
        }
    },

    mutations: {
        SET_AGENCY_ADDRESS (state, value) {
            state.agencyAddress = value
        }
    },

    actions: {
        async setAgencyAddress ({ dispatch, commit, rootGetters }, data) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/agencies/${data.agencyId}/address`, data.address).then((response) => {
                commit('SET_AGENCY_ADDRESS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_AGENCY_ADDRESS', [])
                throw err
            })
        },
        async getAgencyAddress ({ dispatch, commit, rootGetters }, agencyId) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/agencies/${agencyId}/address`).then((response) => {
                commit('SET_AGENCY_ADDRESS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_AGENCY_ADDRESS', [])
                throw err
            })
        }
    }
}
