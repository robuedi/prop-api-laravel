import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth.module'
import properties from './properties.module'
import propertiesStatuses from './propertiesStatuses.module'
import cities from './cities.module'
import countries from './countries.module'
import annualSalary from './annualSalary.module'
import rent from './rent.module'
import userEmployment from './userEmployment.module'
import userAddress from './userAddress.module'
import savings from './savings.module'
import agencyAddress from './agencyAddress.module'
import agencyInfo from './agencyInfo.module'
import propertyTypes from './propertyTypes.module'
import propertyAddress from './propertyAddress.module'
import paramsPropertyIndex from './params/properties/index.module'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        properties,
        propertiesStatuses,
        cities,
        countries,
        annualSalary,
        rent,
        userEmployment,
        userAddress,
        savings,
        agencyAddress,
        agencyInfo,
        propertyTypes,
        propertyAddress,
        paramsPropertyIndex
    }
})
