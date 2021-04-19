import Api from '../Api'

const VERSION = 'v1'
const END_POINT = `roles`

export default {
    all(){
        return Api.get(`${VERSION}/${END_POINT}`);
    },
}
