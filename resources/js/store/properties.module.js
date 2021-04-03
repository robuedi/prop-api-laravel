export default {
    namespaced: true,

    state: {
        userProperty: null,
        property: null,
        properties: [],
        userProperties: [],
        userApplications: []
    },

    getters: {
        property (state) {
            return state.property
        },

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
    },

    mutations: {
        SET_PROPERTY (state, value) {
            state.property = value
        },

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

        async getProperties({ commit, rootGetters }){
            return axios.get(`/api/v1/properties${rootGetters['paramsPropertyIndex/query']}`).then((response) => {
                commit('SET_PROPERTIES', response.data.data)
                return response
            }).catch((error) => {
                commit('SET_PROPERTIES', [])
                throw error
            })
        },

        clearProperty({commit})
        {
            commit('SET_PROPERTY', null)
        },
    }
}
