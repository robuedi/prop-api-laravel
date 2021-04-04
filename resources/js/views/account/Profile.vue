<template>
    <div>
        <router-view></router-view>
        <AccountNavigation activeSection="accountProfile"/>
        <template v-if="user">
            <p>
                <strong>Name</strong>: {{user.name}}
                <br/>
                <strong>Email</strong>: {{user.email}}
                <br/>
                <strong>Account type:</strong>
                <span v-if="user.type_id === 1">Tenant</span>
                <span v-else-if="user.type_id === 2">Buyer</span>
                <span v-else-if="user.type_id === 3">Landlord</span>
                <span v-else-if="user.type_id === 4">Seller</span>
            </p>
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
