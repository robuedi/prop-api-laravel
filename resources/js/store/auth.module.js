import apiStates from "./apiStates/apiStateValues";

export default {
    namespaced: true,

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

        async checkUserProfileComplete({dispatch}, data)
        {
            return await axios.put(`/api/v1/roles-users/${data.roleUserId}`, data.data).then((res) => {
                return dispatch('me').then(() => {
                    return res;
                })
            });
        },

        setActiveRole({dispatch, commit}, activeRole)
        {
            commit('SET_ACTIVE_ROLE', activeRole)
            axios.put(`/api/v1/roles-users/${activeRole.id}`, {is_used: 1}).then((res) => {
                return dispatch('me').then(() => {
                    return res;
                })
            });
        },

        async me ({ commit }) {
            return await axios.get('/api/user').then((response) => {
                commit('SET_AUTHENTICATED', true)
                commit('SET_USER', response.data)
                commit('SET_AUTH_API_STATE', apiStates.LOADED)

                const usedRole = response.data.user_role.filter((_userRole => _userRole.is_used === 1))
                if(usedRole.length === 1) {
                    commit('SET_ACTIVE_ROLE', usedRole[0])
                }
            }).catch(() => {
                commit('SET_AUTHENTICATED', false)
                commit('SET_USER', null)
                commit('SET_ACTIVE_ROLE', null)
                commit('SET_AUTH_API_STATE', apiStates.ERROR)
            })
        }
    }
}
