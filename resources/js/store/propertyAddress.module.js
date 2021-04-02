export default {
    namespaced: true,

    state: {
        propertyAddress: [],
    },

    getters: {
        propertyAddress (state) {
            return state.propertyAddress
        }
    },

    mutations: {
        SET_PROPERTY_ADDRESS (state, value) {
            state.propertyAddress = value
        }
    },

    actions: {
        async storePropertyAddress ({ commit, rootGetters }, data) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/properties/${data.propertyId}/addresses`, data.address).then((response) => {
                commit('SET_PROPERTY_ADDRESS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_PROPERTY_ADDRESS', [])
                throw err
            })
        },

    }
}
