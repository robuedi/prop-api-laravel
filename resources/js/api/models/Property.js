import Api from '../Api'

const VERSION = 'v1'
const END_POINT = 'properties'

export default {

    all(query = ''){
        return Api.get(`${VERSION}/${END_POINT}${query}`);
    },

    showSlug(slug, query = ''){
        return Api.get(`${VERSION}/${END_POINT}/${slug}${query}`);
    },

}
