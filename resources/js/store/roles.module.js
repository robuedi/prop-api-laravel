export default {
    namespaced: true,

    state: {
        roles: [],
    },

    getters: {
        roles (state) {
            return state.roles
        }
    },

    mutations: {
        SET_ROLES (state, value) {
            state.roles = value
        }
    },

    actions: {
        async getRoles ({ commit }) {
            return axios.get(`/api/v1/roles`).then((response) => {
                commit('SET_ROLES', response.data.data)
                return response
            }).catch((err) => {
                commit('SET_ROLES', [])
                throw err
            })
        },

        async setUserRole ({ dispatch, commit, rootGetters }, roleId) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/roles/${roleId}`, data).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        }
    }
}
