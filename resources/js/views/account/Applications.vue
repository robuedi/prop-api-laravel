<template>
    <div>
        <AccountNavigation activeSection="userApplications"/>
        <div class="card-columns" v-if="userApplications.length > 0">
            <PropertyItemAccount v-for="property in userApplications" :key="property.id" :property="property"/>
        </div>
        <p v-if="loadingStatus">{{ loadingStatus }}</p>
    </div>
</template>

<script>
import AccountNavigation from "../../layout/account/AccountNavigation";
import PropertyItemAccount from "../../components/account/PropertyItemAccount";
import {mapGetters} from "vuex";
import PropertyApplications from "../../api/models/PropertyApplications";

export default {
    components: {
        PropertyItemAccount,
        AccountNavigation
    },
    data() {
        return {
            userApplications: [],
            loadingStatus: 'Loading data...'
        }
    },
    computed: {
        ...mapGetters('auth', {
            activeRole: 'activeRole',
        }),
    },
    mounted() {
        PropertyApplications.all(this.activeRole.id).then((res) => {
            this.userApplications = res.data.data
            this.loadingStatus = this.userApplications.length === 0 ? 'No applications found.' : ''
        }).catch((error) => {
            this.loadingStatus = 'We encountered problems loading the data...'
            throw error
        })
    }
}
</script>
