<template>
    <div>
        <AccountNavigation activeSection="userProperties"/>
        <div class="card-columns" v-if="userProperties">
            <PropertyItemAccount v-for="property in userProperties" :key="property.id" :property="property"/>
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
    data () {
        return {
            properties: [],
        }
    },
    computed: {
        ...mapGetters('properties',{
            userProperties: 'userProperties',
        })
    },
    mounted() {
        this.fetchProperties();
    },
    methods: {
        ...mapActions('properties', ['getUserProperties']),
        fetchProperties(){
            this.getUserProperties().then((res) => {
            }).catch((error) => {
                throw error
            })
        }
    }
}
</script>
