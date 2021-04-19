import Api from '../Api'

const END_POINT = (agencyId) => `agencies/${agencyId}/addresses`
const END_POINT_VERSION = 'v1'

export default {
    store(agencyId, data){
        return Api.post(`${END_POINT_VERSION}/${END_POINT(agencyId)}`, data);
    },

    all(agencyId){
        return Api.get(`${END_POINT_VERSION}/${END_POINT(agencyId)}`);
    },
}
