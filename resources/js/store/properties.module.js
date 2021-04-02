export default {
    namespaced: true,

    state: {
        userProperty: null,
        propertyAddress: null,
        properties: [],
        userProperties: [],
        userApplications: []
    },

    getters: {
        properties (state) {
            return state.properties
        },

        userProperties (state) {
            return state.userProperties
        },

        userApplications (state) {
            return state.userApplications
        },

        userProperty (state) {
            return state.userProperty
        },

        propertyAddress (state) {
            return state.propertyAddress
        },
    },

    mutations: {
        SET_PROPERTIES (state, value) {
            state.properties = value
        },

        SET_USER_PROPERTIES (state, value) {
            state.userProperties = value
        },

        SET_USER_APPLICATIONS (state, value) {
            state.userApplications = value
        },

        SET_USER_PROPERTY (state, value) {
            state.userProperty = value
        },

        SET_PROPERTY_ADDRESS (state, value) {
            state.propertyAddress = value
        }
    },

    actions: {
        async storeUserProperty ({ dispatch, commit, rootGetters }, property) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/properties`, property).then((response) => {
                commit('SET_USER_PROPERTY', response.data.data)
                return response.data.data
            }).catch((err) => {
                commit('SET_USER_PROPERTY', null)
                throw err
            })
        },

        async showProperty ({ dispatch, commit }, propertyId) {
            await axios.get('/api/v1/properties/'+propertyId).then((response) => {
                commit('SET_PROPERTY', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_PROPERTY', null)
                throw err
            })
        },

        async getUserProperties ({ commit, rootGetters }) {
            console.log('test')
            await axios.get(`/api/v1/users/${rootGetters['auth/userId']}/properties/`).then((response) => {
                commit('SET_USER_PROPERTIES', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_USER_PROPERTIES', [])
                throw err
            })
        },

        async getUserApplications ({ commit, rootGetters }) {
            await axios.get(`/api/v1/users/${rootGetters['auth/userId']}/property-applications/`).then((response) => {
                commit('SET_USER_APPLICATIONS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_USER_APPLICATIONS', [])
                throw err
            })
        },

        clearProperty({commit})
        {
            commit('SET_PROPERTY', null)
        },

        async showPropertyAddress ({ dispatch, commit }, propertyId) {
            await axios.get('/api/v1/properties/'+propertyId+'/address').then((response) => {
                commit('SET_PROPERTY_ADDRESS', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_PROPERTY_ADDRESS', null)
                throw err
            })
        }
    }
}
