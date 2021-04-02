<template>
    <div>
        <router-view></router-view>
        <AccountNavigation activeSection="accountProfile"/>
        <template v-if="user">
            <p>{{user.name}}</p>
            <p>{{user.email}}</p>
        </template>
    </div>
</template>

<script>
import AccountNavigation from "./partials/AccountNavigation";
import {mapGetters} from "vuex";

export default {
    components: {
        AccountNavigation
    },
    computed: {
        ...mapGetters('auth',{
            user: 'user',
        }),
    },
}
</script>

<style scoped>

</style>
