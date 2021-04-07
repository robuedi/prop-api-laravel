<template>
    <div>
        <h1 class="mb-4">Complete Registration</h1>
        <button type="button" @click="$router.push({name: 'chooseRoles'})" class="btn btn-outline-dark btn-md mb-5">
            Choose profiles
        </button>

        <p v-if="authApiStateLoading">Loading...</p>
        <p v-if="checkingProfileComplete">{{ checkingProfileComplete }}</p>

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

import Buyer from './complete-register/Buyer'
import Seller from './complete-register/Seller'
import Tenant from './complete-register/Tenant'
import Landlord from './complete-register/Landlord'
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
            selectedUserRole: null,
            checkingProfileComplete: ''
        }
    },
    computed: {
        ...mapGetters('auth', {
            user: 'user',
            authApiState: 'authApiState',
        }),
        authApiStateLoaded() {
            return this.authApiState === apiStates.LOADED;
        },
        authApiStateLoading() {
            return this.authApiState === apiStates.INIT || this.apiState === apiStates.LOADING;
        }
    },
    methods: {
        ...mapActions('auth', [
            'checkUserProfileComplete',
            'setActiveRole',
            'me',
        ]),
        getSelectedUserRole(){
            this.selectedUserRole = this.user.user_role.filter(userRole => userRole.id === parseInt(this.$route.params.userRoleId)).shift()
        },
        checkIfProfileCompleted()
        {
            //check if the user role is now completed
            this.checkingProfileComplete = 'Checking if the profile is complete..'
            this.checkUserProfileComplete(this.selectedUserRole.id).then((res) => {
                this.checkingProfileComplete = 'The profile is complete, please wait..'
                if(res.status === true)
                {
                    //refresh user data
                    this.me().then(() => {
                        let activeRole = this.user.user_role.filter(userRole => userRole.id === parseInt(this.$route.params.userRoleId)).shift()
                        this.setActiveRole(activeRole)
                        this.$router.push({name: 'accountProfile'})
                    });
                }
            }).catch(() => {
                this.checkingProfileComplete = 'Something went wrong.';
            });
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





