export default {
    namespaced: true,

    state: {
        propertyTypes: [],
    },

    getters: {
        propertyTypes (state) {
            return state.propertyTypes
        }
    },

    mutations: {
        SET_PROPERTY_TYPES (state, value) {
            state.propertyTypes = value
        }
    },

    actions: {
        async getPropertyTypes ({ commit }) {
            if(this.state.propertyTypes)
            {
                return
            }

            await axios.get('/api/v1/property-types?fields=id,label').then((response) => {
                commit('SET_PROPERTY_TYPES', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_PROPERTY_TYPES', [])
                return err
            })
        },
    }
}
