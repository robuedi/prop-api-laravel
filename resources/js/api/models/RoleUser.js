import Api from '../Api'
import store from '../../store/index'

const END_POINT = `users/${store.getters.user.id}/roles-users`
const END_POINT_VERSION = 'v1'

export default {
    store(roleId){
        return Api.post(`${END_POINT_VERSION}/${END_POINT}`, {role_id: roleId});
    },
}
