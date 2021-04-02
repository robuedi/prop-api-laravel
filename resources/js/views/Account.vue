<template>
    <router-view v-if="profileCompleted"/>
</template>

<script>

import { mapGetters } from 'vuex'

export default {
    watch: {
        user() {
            this.profileCompletedCheck();
        }
    },
    computed: {
        ...mapGetters('auth', ['user', 'profileCompleted'])
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
