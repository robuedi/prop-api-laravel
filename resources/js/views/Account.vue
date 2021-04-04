<template>
    <div >
        <router-view v-if="profileCompleted" />
        <p v-else-if="apiStateLoading">Loading...</p>
    </div>
</template>

<script>

import apiStates from "../store/apiStates/apiStateValues";

import { mapGetters } from 'vuex'

export default {
    watch: {
        apiStateLoaded() {
            this.profileCompletedCheck();
        }
    },
    computed: {
        ...mapGetters('auth', {
            profileCompleted: 'profileCompleted',
            apiState: 'apiState'
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
            if(!this.profileCompleted)
            {
                this.$router.push({name: 'completeRegister'})
            }
        }
    }
}
</script>
