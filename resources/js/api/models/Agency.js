import Api from '../Api'

const END_POINT = (roleUserId) => `roles-users/${roleUserId}/agencies`
const END_POINT_VERSION = 'v1'

export default {
    store(roleUserId, data){
        return Api.post(`${END_POINT_VERSION}/${END_POINT(roleUserId)}`, data);
    },

    all(roleUserId){
        return Api.get(`${END_POINT_VERSION}/${END_POINT(roleUserId)}`);
    },
}
