import Api from '../Api'

const END_POINT = (roleUserId) => `roles-users/${roleUserId}/annual-salaries`
const END_POINT_VERSION = 'v1'

export default {
    store(data){
        return Api.post(`${END_POINT_VERSION}/${END_POINT(data.roleUserId)}`, {amount: data.amount});
    },

    all(roleUserId){
        return Api.get(`${END_POINT_VERSION}/${END_POINT(roleUserId)}`);
    },
}
