export default {
    namespaced: true,

    actions: {

        async setUserRole ({ rootGetters }, roleId) {
            return axios.post(`/api/v1/users/${rootGetters['auth/userId']}/roles-users`, {role_id: roleId}).then((response) => {
                return response.data.data
            }).catch((err) => {
                throw err
            })
        }
    }
}
