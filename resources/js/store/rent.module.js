export default {
    namespaced: true,

    actions: {
        async setRent ({ dispatch, commit, rootGetters }, amount) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/rents`, amount).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },
        async getCurrentUserRent ({ commit, rootGetters }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/rents`).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        }
    }
}
