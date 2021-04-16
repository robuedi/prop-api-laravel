export default {
    actions: {
        async bookProperty ({ dispatch, commit }, data) {
            return axios.post(`/api/v1/users-properties/`, data).then((response) => {
                return response
            }).catch((err) => {
                throw err
            })
        },
    }
}
