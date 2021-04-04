export default {
    namespaced: true,

    state: {
        fields: [],
        address: [],
        city: [],
        country: [],
        userType: false
    },

    getters: {
        fields (state) {
            return state.fields
        },
        address (state) {
            return state.address
        },
        city (state) {
            return state.city
        },
        country (state) {
            return state.country
        },

        query (state) {
            let queryItems = []

            if(state.fields.length > 0)
            {
                queryItems.push('fields='+state.fields.join(','))
            }

            if(state.address.length > 0)
            {
                queryItems.push('has_address='+state.address.join(','))
            }

            if(state.city.length > 0)
            {
                queryItems.push('has_city='+state.city.join(','))
            }

            if(state.country.length > 0)
            {
                queryItems.push('has_country='+state.country.join(','))
            }

            if(state.userType)
            {
                queryItems.push('has_user_type=true')
            }

            return queryItems.length > 0 ? '?'+queryItems.join('&') : ''
        },
    },

    mutations: {
        SET_FIELDS (state, value) {
            state.fields = value
        },
        SET_ADDRESS (state, value) {
            state.address = value
        },
        SET_CITY (state, value) {
            state.city = value
        },
        SET_COUNTRY (state, value) {
            state.country = value
        },
        SET_USER_TYPE (state, value) {
            state.userType = value
        }
    },

    actions: {
         setFields ({commit}, values) {
             if(values)
             {
                 commit('SET_FIELDS', values)
             }
             else
             {
                 commit('SET_FIELDS', [])
             }
        },
         setAddress ({commit}, values) {
             if(values)
             {
                 commit('SET_ADDRESS', values)
             }
             else
             {
                 commit('SET_ADDRESS', [])
             }
        },
         setCity ({commit}, values) {
             if(values)
             {
                 commit('SET_CITY', values)
             }
             else
             {
                 commit('SET_CITY', [])
             }
        },
         setCountry ({commit}, values) {
             if(values)
             {
                 commit('SET_COUNTRY', values)
             }
             else
             {
                 commit('SET_COUNTRY', [])
             }
        },
         setUserType ({commit}, values) {
             if(values)
             {
                 commit('SET_USER_TYPE', values)
             }
             else
             {
                 commit('SET_USER_TYPE', false)
             }
        },
    }
}
