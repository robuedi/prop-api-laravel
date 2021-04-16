export default {
    actions: {
        async setAgencyAddress ({ rootGetters }, data) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/agencies/${data.agencyId}/addresses`, data.address).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },
        async getAgencyAddress ({ rootGetters }, agencyId) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/agencies/${agencyId}/addresses`).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        }
    }
}
