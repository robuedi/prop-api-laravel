<template>
    <div>
        <AccountNavigation activeSection="userApplications"/>
        <div class="card-columns" v-if="userApplications">
            <PropertyItemAccount v-for="property in userApplications" :key="property.id" :property="property"/>
        </div>
    </div>
</template>

<script>
import AccountNavigation from "./partials/AccountNavigation";
import PropertyItemAccount from "../../components/partials/PropertyItemAccount";
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        PropertyItemAccount,
        AccountNavigation
    },
    computed: {
        ...mapGetters('userProperties',{
            userApplications: 'userApplications',
        })
    },
    mounted() {
        this.fetchProperties();
    },
    methods: {
        ...mapActions('userProperties', ['getUserApplications']),
        fetchProperties(){
            this.getUserApplications().then((res) => {
            }).catch((error) => {
                throw error
            })
        }
    }
}
</script>
