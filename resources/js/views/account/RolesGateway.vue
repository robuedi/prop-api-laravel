<template>
    <div>
        <p v-if="this.authApiStateLoading">Loading..</p>
        <template v-if="this.authApiStateLoaded && userRolesList">
            <SelectProfile :userRolesList="userRolesList"/>
        </template>
        <template v-else-if="this.authApiStateLoaded ">
            <CreateProfile />
        </template>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";

import CreateProfile from './role-gateway-sections/CreateProfile'
import SelectProfile from './role-gateway-sections/SelectProfile'
import apiStates from "../../store/apiStates/apiStateValues";

export default {
    components: {
        CreateProfile,
        SelectProfile
    },
    watch: {
        authApiStateLoaded() {
            this.initLoad()
        }
    },
    data() {
      return{
          roleSelectionActive: false,
          userRolesList: []
      }
    },
    computed: {
        ...mapGetters('auth', {
            user: 'user',
            authApiState: 'apiState'
        }),
        authApiStateLoaded() {
            return this.authApiState === apiStates.LOADED;
        },
        authApiStateLoading() {
            return this.authApiState === apiStates.INIT || this.apiState === apiStates.LOADING;
        }
    },
    methods: {
        ...mapActions('auth', ['setActiveRole']),
        chooseAccountActions()
        {
            if(this.user.user_role.length === 0)
            {
                this.$router.push({name: 'makeRole'})
            }
            else if(this.user.user_role.length > 0)
            {
                this.checkExistingRoles(this.user.user_role)
            }
        },
        checkExistingRoles(userRoles)
        {
            //check roles
            let activeRoles = userRoles.filter(userRole => userRole.is_completed === 1);

            //one active role found -> go to it
            if(activeRoles.length === 1 && this.user.user_role.length === 1)
            {
                this.setActiveRole(activeRoles[0])
                this.$router.push({name: 'accountProfile'})
            }
            else
            {
                this.userRolesList = userRoles
            }
        },
        initLoad() {
            if(this.authApiStateLoaded === true) {
                this.chooseAccountActions();
            }
        }
    },
    mounted() {
        this.initLoad()
    }
}
</script>

<style scoped>

</style>
