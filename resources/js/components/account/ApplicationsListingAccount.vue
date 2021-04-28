<template>
    <div>
        <div class="card-columns" v-if="userApplications">
            <PropertyItemAccount v-for="property in userApplications" :key="property.id" :property="property"/>
        </div>
    </div>
</template>

<script>
import PropertyItemAccount from "./PropertyItemAccount";
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        PropertyItemAccount
    },
    computed: {
        ...mapGetters('properties',{
            userApplications: 'userApplications',
        })
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
