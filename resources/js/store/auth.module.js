import apiStates from "./apiStates/apiStateValues";

export default {
    state: {
        authApiState: apiStates.INIT,
        authenticated: false,
        user: null,
        activeRole : null
    },

    getters: {
        authenticated (state) {
            return state.authenticated
        },

        user (state) {
            return state.user
        },

        activeRole (state) {
            return state.activeRole
        },

        userId (state) {
            if(state.user) {
                return state.user.id
            }
            else {
                return null;
            }
        },

        authApiState (state) {
            return state.authApiState
        },
    },

    mutations: {
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },

        SET_USER (state, value) {
            state.user = value,
            state.apiState = apiStates.LOADING
        },

        SET_ACTIVE_ROLE (state, value) {
            state.activeRole = value,
            state.apiState = apiStates.LOADING
        },

        SET_AUTH_API_STATE (state, value) {
            state.authApiState = value
        }
    },

    actions: {
        async signIn ({ dispatch }, credentials) {
            await axios.get('/sanctum/csrf-cookie')
            return axios.post('/api/login', credentials).then((res) =>{
                return dispatch('me').then(() => {
                    return res
                })
            }).catch((error) => {
                return dispatch('me').then(() => {
                    throw error
                })
            })
        },

        async register ({ dispatch }, user) {
            await axios.get('/sanctum/csrf-cookie')
            return axios.post('/api/register', user)
        },

        async signOut ({ dispatch }) {
            await axios.post('/api/logout').then(() => {
                return dispatch('me')
            })
        },

        async checkUserProfileComplete({dispatch, rootGetters}, userRoleId)
        {
            return await axios.get(`/api/v1/users/${rootGetters['auth/userId']}/roles-users/${userRoleId}/check-complete`).then((res) => {
                return dispatch('me').then(() => {
                    return res.data.data;
                })
            });
        },

        setActiveRole({dispatch, commit}, activeRole)
        {
            commit('SET_ACTIVE_ROLE', activeRole)
        },

        async me ({ commit }) {
            return await axios.get('/api/user').then((response) => {
                commit('SET_AUTHENTICATED', true)
                commit('SET_USER', response.data)
                commit('SET_AUTH_API_STATE', apiStates.LOADED)
            }).catch(() => {
                commit('SET_AUTHENTICATED', false)
                commit('SET_USER', null)
                commit('SET_AUTH_API_STATE', apiStates.ERROR)
            })
        }
    }
}
