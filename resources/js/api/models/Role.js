import Api from '../Api'

const END_POINT = `roles`
const END_POINT_VERSION = 'v1'

export default {
    all(){
        return Api.get(`${END_POINT_VERSION}/${END_POINT}`);
    },
}
