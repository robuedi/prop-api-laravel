import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth.module'
import properties from './properties.module'
import propertiesStatuses from './propertiesStatuses.module'
import countries from './countries.module'
import annualSalary from './annualSalary.module'
import rent from './rent.module'
import userEmployment from './userEmployment.module'
import userAddress from './userAddress.module'
import savings from './savings.module'
import userAgencyAddress from './userAgencyAddresses.module'
import userAgencies from './userAgencies.module'
import propertyTypes from './propertyTypes.module'
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
        userAddress,
        savings,
        userAgencyAddress,
        userAgencies,
        propertyTypes,
        propertyAddress,
        roles,
        roleUser,
        propertyUser
    }
})
