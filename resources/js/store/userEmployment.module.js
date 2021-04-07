export default {
    namespaced: true,

    actions: {
        async setEmployment ({ dispatch, commit, rootGetters }, data) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/employments`, data).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },
        async getCurrentUserEmployment ({ commit, rootGetters }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/employments`).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        }
    }
}
