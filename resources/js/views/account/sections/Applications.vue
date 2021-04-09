<template>
    <div>
        <AccountNavigation activeSection="userApplications"/>
        <div class="card-columns" v-if="userApplications">
            <PropertyItemAccount v-for="property in userApplications" :key="property.id" :property="property"/>
        </div>
    </div>
</template>

<script>
import AccountNavigation from "../layout/AccountNavigation";
import PropertyItemAccount from "../partials/PropertyItemAccount";
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        PropertyItemAccount,
        AccountNavigation
    },
    data() {
        return {
            userApplications: []
        }
    },
    mounted() {
        this.fetchProperties();
    },
    methods: {
        ...mapActions('properties', ['getUserApplications']),
        fetchProperties(){
            this.getUserApplications().then((res) => {
            }).catch((error) => {
                throw error
            })
        }
    }
}
</script>
