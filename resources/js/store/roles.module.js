export default {
    actions: {
        async getRoles ({ commit }) {
            return axios.get(`/api/v1/roles`).then((response) => {
                return response
            }).catch((err) => {
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
