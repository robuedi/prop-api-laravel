import Property from "../api/models/Property";

export default {
    namespaced: true,

    state: {
        property: null,
    },

    getters: {
        property (state) {
            return state.property
        },
    },

    mutations: {
        SET_PROPERTY (state, value) {
            state.property = value
        },
    },

    actions: {
        async showSlugProperty ({ dispatch, commit }, data) {
            await Property.showSlug(data.slug, data.query).then((response) => {
                commit('SET_PROPERTY', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_PROPERTY', null)
                throw err
            })
        },

        async getAll({ commit }, query = ''){
            return Property.all(query)
        },

        async storeUserProperty ({ rootGetters }, property) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/properties`, property).then((response) => {
                return response.data.data
            }).catch((err) => {
                throw err
            })
        },

        async getUserProperties ({ rootGetters }) {
            await axios.get(`/api/v1/users/${rootGetters['auth/userId']}/properties/`).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },

        async getUserApplications ({ rootGetters }) {
            await axios.get(`/api/v1/users/${rootGetters['auth/userId']}/property-applications/`).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },
    }
}
