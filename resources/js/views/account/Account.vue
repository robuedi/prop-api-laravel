<template>
    <div >
        <router-view v-if="activeRole" />
        <p v-else-if="apiStateLoading">Loading...</p>
    </div>
</template>

<script>

import apiStates from "../../store/apiStates/apiStateValues";

import { mapGetters } from 'vuex'

export default {
    watch: {
        apiStateLoaded() {
            this.profileCompletedCheck();
        }
    },
    computed: {
        ...mapGetters('auth', {
            authenticated: 'authenticated',
            activeRole: 'activeRole',
            apiState: 'authApiState'
        }),
        apiStateLoaded() {
            return this.apiState === apiStates.LOADED;
        },
        apiStateLoading() {
            return this.apiState === apiStates.INIT || this.apiState === apiStates.LOADING;
        }
    },
    methods: {
        profileCompletedCheck()
        {
            if(this.apiStateLoaded !== true)
            {
                return;
            }

            if(!this.authenticated)
            {
                this.$router.push({name: 'signIn'})
            }
            else if(this.authenticated && !this.activeRole)
            {
                this.$router.push({name: 'chooseRoles'})
            }
        }
    },
    mounted() {
        this.profileCompletedCheck()
    }
}
</script>
