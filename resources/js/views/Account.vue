<template>
    <div v-if="profileCompleted">
        <router-view />
    </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {
    watch: {
        profileCompleted() {
            this.profileCompletedCheck();
        }
    },
    computed: {
        ...mapGetters('auth', ['profileCompleted'])
    },
    methods: {
        profileCompletedCheck()
        {
            if(!this.profileCompleted)
            {
                this.$router.push({name: 'completeRegister'})
            }
        }
    },
    mounted() {
        this.profileCompletedCheck()
    }
}
</script>
