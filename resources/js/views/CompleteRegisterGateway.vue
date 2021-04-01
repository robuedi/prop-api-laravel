<template>
    <div>
        <h1 class="mb-4">Complete Registration</h1>

        <Tenant v-on:checkIfProfileCompleted="checkIfProfileCompleted" v-if="checkIfType(1)" />
        <Buyer v-on:checkIfProfileCompleted="checkIfProfileCompleted" v-else-if="checkIfType(2)" />
        <Landlord v-else-if="checkIfType(3)" />
        <Seller v-else-if="checkIfType(4)" />
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

import Buyer from '../components/complete-register/Buyer'
import Seller from '../components/complete-register/Seller'
import Tenant from '../components/complete-register/Tenant'
import Landlord from '../components/complete-register/Landlord'

export default {
    components: {
        Buyer,
        Seller,
        Tenant,
        Landlord
    },
    computed: {
        ...mapGetters('auth',{
            user: 'user'
        })
    },
    methods: {
        ...mapActions('auth', ['checkUserProfileComplete']),
        checkIfType(type_id)
        {
            if(!this.user)
            {
                return;
            }
            return this.user.type_id === type_id
        },
        checkIfProfileCompleted()
        {
            this.checkUserProfileComplete().then((res) => {
                if(res.data.data.status)
                {
                    this.$router.replace({name: 'account'})
                }
            });
        }
    },
}
</script>





