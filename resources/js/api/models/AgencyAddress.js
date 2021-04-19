import Api from '../Api'

const VERSION = 'v1'
const END_POINT = (agencyId) => `agencies/${agencyId}/addresses`

export default {
    store(agencyId, data){
        return Api.post(`${VERSION}/${END_POINT(agencyId)}`, data);
    },

    all(agencyId){
        return Api.get(`${VERSION}/${END_POINT(agencyId)}`);
    },
}
