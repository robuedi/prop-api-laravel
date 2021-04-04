import apiStates from "./apiStates/apiStateValues";

export default {
    namespaced: true,

    state: {
        apiState: apiStates.INIT,
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

        apiState (state) {
            return state.apiState
        },
    },

    mutations: {
        SET_USER_PROPERTIES (state, value) {
            state.apiState = apiStates.LOADING
            state.userProperties = value
        },

        SET_USER_APPLICATIONS (state, value) {
            state.apiState = apiStates.LOADING
            state.userApplications = value
        },

        SET_API_STATE (state, value) {
            state.apiState = value
        }
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
                commit('SET_API_STATE', apiStates.LOADED)
                return response
            }).catch((err) => {
                commit('SET_USER_PROPERTIES', [])
                commit('SET_API_STATE', apiStates.ERROR)
                throw err
            })
        },

        async getUserApplications ({ commit, rootGetters }) {
            await axios.get(`/api/v1/users/${rootGetters['auth/userId']}/property-applications/`).then((response) => {
                commit('SET_USER_APPLICATIONS', response.data.data)
                commit('SET_API_STATE', apiStates.LOADED)
                return response
            }).catch((err) => {
                commit('SET_USER_APPLICATIONS', [])
                commit('SET_API_STATE', apiStates.ERROR)
                throw err
            })
        },
    }
}
