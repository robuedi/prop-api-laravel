import Api from '../Api'

const VERSION = 'v1'
const END_POINT = 'countries'

export default {
    all(query = ''){
        return Api.get(`${VERSION}/${END_POINT}${query}`);
    },
}
