<template>
    <div>
        <router-view></router-view>
        <AccountNavigation activeSection="accountProfile"/>
        <template v-if="user">
            <p class="mb-3">
                <strong>Name</strong>: {{user.name}}
                <br/>
                <strong>Email</strong>: {{user.email}}
                <br/>
                <strong>Account type:</strong> <span >{{activeRole.role.name}}</span>
            </p>
            <button type="button" @click="$router.push({name: 'chooseRoles'})" class="btn btn-outline-dark btn-md mb-5">
                Change profile
            </button>
        </template>
    </div>
</template>

<script>
import AccountNavigation from "../layout/AccountNavigation";
import {mapGetters} from "vuex";

export default {
    components: {
        AccountNavigation
    },
    computed: {
        ...mapGetters('auth',{
            user: 'user',
            activeRole: 'activeRole'
        }),
    },
}
</script>

<style scoped>

</style>
