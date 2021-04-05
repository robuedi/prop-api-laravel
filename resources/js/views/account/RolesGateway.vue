<template>
    <div>
        <p v-if="this.authApiStateLoading">Loading..</p>
        <template v-if="this.authApiStateLoaded ">
            <SelectProfile :userRolesList="userRolesList"/>
        </template>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";

import SelectProfile from './role-gateway-sections/SelectProfile'
import apiStates from "../../store/apiStates/apiStateValues";

export default {
    components: {
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
            authApiState: 'authApiState'
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
            if(this.user.user_role.length > 0)
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

            console.log(this.authApiState);
            if(this.authApiStateLoaded) {
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
