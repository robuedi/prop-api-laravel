import Api from '../Api'
import store from '../../store/index'

const END_POINT = `users/${store.getters.user.id}/rents`
const END_POINT_VERSION = 'v1'

export default {
    store(amount){
        return Api.post(`${END_POINT_VERSION}/${END_POINT}`, amount);
    },

    all(){
        return Api.get(`${END_POINT_VERSION}/${END_POINT}`);
    },
}
