export default {
    namespaced: true,

    state: {
        property: null,
        properties: [],
    },

    getters: {
        property (state) {
            return state.property
        },

        properties (state) {
            return state.properties
        },
    },

    mutations: {
        SET_PROPERTY (state, value) {
            state.property = value
        },

        SET_PROPERTIES (state, value) {
            state.properties = value
        },
    },

    actions: {
        async showProperty ({ dispatch, commit }, propertyId) {
            await axios.get('/api/v1/properties/'+propertyId).then((response) => {
                commit('SET_PROPERTY', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_PROPERTY', null)
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
    }
}
