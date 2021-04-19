import Api from '../Api'
import store from '../../store/index'

const VERSION = 'v1'
const END_POINT = () => `users/${store.getters['auth/userId']}/roles-users`

export default {
    store(roleId){
        return Api.post(`${VERSION}/${END_POINT()}`, {role_id: roleId});
    },
}
