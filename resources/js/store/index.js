import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth.module'
import properties from './properties.module'
import propertiesStatuses from './propertiesStatuses.module'
import countries from './countries.module'
import annualSalary from './annualSalary.module'
import rent from './rent.module'
import employment from './employment.module'
import roleUserAddress from './roleUserAddress.module'
import savings from './savings.module'
import agencyAddress from './agencyAddresses.module'
import agencies from './agencies.module'
import propertyAddress from './propertyAddress.module'
import roles from './roles.module'
import roleUser from './roleUser.module'
import propertyUser from './propertyUser.module'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        properties,
        propertiesStatuses,
        countries,
        annualSalary,
        rent,
        userEmployment,
        roleUserAddress,
        savings,
        agencyAddress,
        agencies,
        propertyAddress,
        roles,
        roleUser,
        propertyUser
    }
})
