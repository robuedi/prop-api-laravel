export default {
    namespaced: true,

    state: {
        userProperties: [],
        userApplications: []
    },

    getters: {
        userProperties (state) {
            return state.userProperties
        },

        userApplications (state) {
            return state.userApplications
        },
    },

    mutations: {
        SET_USER_PROPERTIES (state, value) {
            state.userProperties = value
        },

        SET_USER_APPLICATIONS (state, value) {
            state.userApplications = value
        },
    },

    actions: {
        async storeUserProperty ({ dispatch, commit, rootGetters }, property) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/properties`, property).then((response) => {
                return response.data.data
            }).catch((err) => {
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

        clearUserProperty({commit})
        {
            commit('SET_USER_PROPERTY', null)
        },
    }
}
