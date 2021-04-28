<template>
    <div>
        <div class="card-columns" v-if="userProperties">
            <PropertyItemAccount v-for="property in userProperties" :key="property.id" :property="property"/>
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
    data () {
        return {
            properties: [],
            userProperties: []
        }
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
