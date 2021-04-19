import Api from '../Api'

const VERSION = 'v1'
const END_POINT = (roleUserId) => `roles-users/${roleUserId}/annual-salaries`

export default {
    store(roleUserId, data){
        return Api.post(`${VERSION}/${END_POINT(roleUserId)}`, data);
    },

    all(roleUserId){
        return Api.get(`${VERSION}/${END_POINT(roleUserId)}`);
    },
}
