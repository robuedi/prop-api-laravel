export default {
    namespaced: true,

    state: {
        authenticated: false,
        user: null
    },

    getters: {
        authenticated (state) {
            return state.authenticated
        },

        profileCompleted (state) {
            if(state.user)
            {
                return state.user.is_completed
            }
            else
            {
                return 0;
            }
        },

        user (state) {
            return state.user
        },

        userId (state) {
            if(state.user)
            {
                return state.user.id
            }
            else
            {
                return null;
            }
        },
    },

    mutations: {
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },

        SET_USER (state, value) {
            state.user = value
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

        async checkUserProfileComplete({dispatch})
        {
            return await axios.get('/api/v1/users/check-profile-completed').then((res) => {
                return dispatch('me').then(() => {
                    return res;
                })
            });
        },

        async me ({ commit }) {
            return await axios.get('/api/user').then((response) => {
                commit('SET_AUTHENTICATED', true)
                commit('SET_USER', response.data)
            }).catch(() => {
                commit('SET_AUTHENTICATED', false)
                commit('SET_USER', null)
            })
        }
    }
}
