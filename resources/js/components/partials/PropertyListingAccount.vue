<template>
    <div>
        <div class="card-columns" v-if="properties">
            <PropertyItemAccount v-for="property in properties" :key="property.id" :property="property"/>
        </div>
    </div>
</template>

<script>
import PropertyItemAccount from "./PropertyItemAccount";

export default {
    components: {
        PropertyItemAccount
    },
    data () {
        return {
            properties: [],
        }
    },
    mounted() {
        this.fetchProperties();
    },
    methods: {
        fetchProperties(){
            axios.get('/api/v1/properties?has_current_user=true&fields=id,created_at&&has_address=postcode,address_line&has_city=name&has_country=name').then((res) => {
                this.properties = res.data.data;
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>
