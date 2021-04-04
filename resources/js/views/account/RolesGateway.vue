<template>
    <div>
        <p v-if="this.authApiStateLoading">Loading..</p>
        <template v-if="this.authApiStateLoaded && roleSelectionActive">
            <button type="button" v-for="userType in userTypes" @click="setUserType(userType.id)" class="btn btn-outline-dark btn-lg btn-block">
                {{ userType.label }}
            </button>
        </template>

    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import apiStates from "../../store/apiStates/apiStateValues";

export default {
    watch: {
        authApiStateLoaded() {
            this.chooseAccountActions();
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
            if(this.user.userRole.length === 0)
            {
                this.$router.push({name: 'makeRole'})
            }
            else if(this.user.userRole.length > 0)
            {
                this.checkExistingRoles(this.user.userRole)
            }
        },
        checkExistingRoles(userRoles)
        {
            //check roles
            let activeRoles = [];
            for(const [index, userRole] of userRoles)
            {
                if(userRole.is_completed === 1)
                {
                    activeRoles.push(userRole)
                }
            }

            //one active role found -> go to it
            if(activeRoles.length === 1)
            {
                this.setActiveUserRole(this.user.userRole[0])
            }
            else if(activeRoles.length > 1)
            {
                this.userRolesList
                this.$router.push({name: 'roleSelectionGateway'})
            }
        },
        setActiveUserRole(userRole)
        {
            this.setActiveRole(userRole)
            this.$router.push({name: 'accountProfile'})
        }
    }
}
</script>

<style scoped>

</style>
