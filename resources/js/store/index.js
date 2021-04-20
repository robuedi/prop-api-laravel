import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth.module'
import propertiesStatuses from './propertiesStatuses.module'
import countries from './countries.module'
import propertyAddress from './propertyAddress.module'
import propertyUser from './propertyUser.module'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        propertiesStatuses,
        countries,
        propertyAddress,
        propertyUser
    }
})
