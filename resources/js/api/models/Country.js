import Api from '../Api'

const END_POINT = 'countries'
const END_POINT_VERSION = 'v1'

export default {
    all(query = ''){
        return Api.get(`${END_POINT_VERSION}/${END_POINT}${query}`);
    },
}
