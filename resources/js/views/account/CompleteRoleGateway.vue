<template>
    <div>
        <h1 class="mb-4">Complete Registration</h1>

        <p v-if="authApiStateLoading">Loading...</p>

        <template v-if="selectedUserRole">

            <h2 v-if="selectedUserRole">{{selectedUserRole.role.name}}</h2>

            <Tenant v-on:checkIfProfileCompleted="checkIfProfileCompleted" v-if="selectedUserRole.role.id === 1" />
            <Buyer v-on:checkIfProfileCompleted="checkIfProfileCompleted" v-else-if="selectedUserRole.role.id === 2" />
            <Landlord v-on:checkIfProfileCompleted="checkIfProfileCompleted"  v-else-if="selectedUserRole.role.id === 3" />
            <Seller v-on:checkIfProfileCompleted="checkIfProfileCompleted"  v-else-if="selectedUserRole.role.id === 4" />
        </template>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

import Buyer from '../../components/complete-register/Buyer'
import Seller from '../../components/complete-register/Seller'
import Tenant from '../../components/complete-register/Tenant'
import Landlord from '../../components/complete-register/Landlord'
import apiStates from "../../store/apiStates/apiStateValues";

export default {
    components: {
        Buyer,
        Seller,
        Tenant,
        Landlord
    },
    watch: {
        authApiStateLoaded() {
            this.initLoad()
        }
    },
    data (){
        return {
            selectedUserRole: null
        }
    },
    computed: {
        ...mapGetters('auth', {
            user: 'user',
            authApiState: 'apiState',
        }),
        authApiStateLoaded() {
            console.log('c2')
            return this.authApiState === apiStates.LOADED;
        },
        authApiStateLoading() {
            return this.authApiState === apiStates.INIT || this.apiState === apiStates.LOADING;
        }
    },
    methods: {
        ...mapActions('auth', [
            'checkUserProfileComplete',
            'me',
        ]),
        getSelectedUserRole(){
            this.selectedUserRole = this.user.user_role.filter(userRole => userRole.id === parseInt(this.$route.params.userRoleId)).shift()
        },
        checkIfProfileCompleted()
        {
            this.checkUserProfileComplete(this.selectedUserRole.id).then((res) => {
                this.doIfCompleted()
            });
        },
        doIfCompleted()
        {
            this.me();
            this.$router.push({name: 'chooseRoles'})
        },
        initLoad(){
            if(this.authApiStateLoaded) {
                this.getSelectedUserRole();
            }
        }
    },
    mounted() {
        this.initLoad()
    }
}
</script>





