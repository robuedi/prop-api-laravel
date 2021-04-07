export default {
    namespaced: true,

    actions: {
        async setSavings ({ dispatch, commit, rootGetters }, amount) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/savings`, amount).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },
        async getCurrentUserSavings ({ commit, rootGetters }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/savings`).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        }
    }
}
