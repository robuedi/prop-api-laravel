export default {
    actions: {
        async setAnnualSalary ({ dispatch, commit, rootGetters }, amount) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/annual-salaries`, amount).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },
        async getCurrentUserAnnualSalary ({ commit, rootGetters }) {
            return axios.get(`/api/v1/users/${rootGetters['auth/userId']}/annual-salaries`).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        }
    }
}
