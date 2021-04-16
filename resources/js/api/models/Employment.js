import Api from '../Api'
import store from '../../store/index'

const END_POINT_VERSION = 'v1'
const END_POINT = `users/${store.getters.user.id}/employments`

export default {
    store(data){
        return Api.post(`${END_POINT_VERSION}/${END_POINT}`, data);
    },

    all(){
        return Api.get(`${END_POINT_VERSION}/${END_POINT}`);
    },
}
