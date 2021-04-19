import Api from '../Api'

const END_POINT = (agencyId) => `agencies/${agencyId}/addresses`
const END_POINT_VERSION = 'v1'

export default {
    store(data){
        return Api.post(`${END_POINT_VERSION}/${END_POINT(data.agencyId)}`, data.data);
    },

    all(agencyId){
        return Api.get(`${END_POINT_VERSION}/${END_POINT(agencyId)}`);
    },
}
