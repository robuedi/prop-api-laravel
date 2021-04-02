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
        async setAgencyAddress ({ dispatch, commit }, data) {
            console.log(data)
            return axios.post('/api/v1/agencies/'+data.agencyId+'/address', data.address).then((response) => {
                commit('SET_AGENCY_ADDRESS', response.data.data)
            }).catch(() => {
                commit('SET_AGENCY_ADDRESS', [])
            })
        },
        async getAgencyAddress ({ dispatch, commit }, agencyId) {
            return axios.get('/api/v1/agencies/'+agencyId+'/address').then((response) => {
                commit('SET_AGENCY_ADDRESS', response.data.data)
            }).catch(() => {
                commit('SET_AGENCY_ADDRESS', [])
            })
        }
    }
}