export default {
    namespaced: true,

    state: {
        property: null,
        propertyAddress: null,
        properties: []
    },

    getters: {
        properties (state) {
            return state.properties
        },

        property (state) {
            return state.property
        },

        propertyAddress (state) {
            return state.propertyAddress
        },
    },

    mutations: {
        SET_PROPERTIES (state, value) {
            state.properties = value
        },

        SET_PROPERTY (state, value) {
            state.property = value
        },

        SET_PROPERTY_ADDRESS (state, value) {
            state.propertyAddress = value
        }
    },

    actions: {
        async setProperty ({ dispatch, commit }, property) {
            return axios.post('/api/v1/properties', property).then((response) => {
                commit('SET_PROPERTY', response.data.data)
                return response.data.data
            }).catch(() => {
                commit('SET_PROPERTY', null)
            })
        },

        async showProperty ({ dispatch, commit }, propertyId) {
            await axios.get('/api/v1/properties/'+propertyId).then((response) => {
                commit('SET_PROPERTY', response.data.data)
            }).catch(() => {
                commit('SET_PROPERTY', null)
            })
        },
        async showPropertyAddress ({ dispatch, commit }, propertyId) {
            await axios.get('/api/v1/properties/'+propertyId+'/address').then((response) => {
                commit('SET_PROPERTY_ADDRESS', response.data.data)
            }).catch(() => {
                commit('SET_PROPERTY_ADDRESS', null)
            })
        }
    }
}
