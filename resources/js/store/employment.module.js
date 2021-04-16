export default {
    actions: {
        async setEmployment ({ rootGetters }, data) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/employments`, data).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },
        async getCurrentUserEmployment ({ rootGetters }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/employments`).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        }
    }
}
