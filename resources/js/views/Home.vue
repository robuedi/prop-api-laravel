<template>
    <div>
        <h1>Properties</h1>
        <div class="card-columns" v-if="properties.length > 0">
            <PropertyItemCard v-for="property in properties" :key="property.id" :property="property"/>
        </div>
        <p v-else >No properties yet.</p>
    </div>
</template>

<script>
import PropertyItemCard from "../components/PropertyItemCard";

export default {
    components: {
        PropertyItemCard
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
            axios.get('/api/v1/properties?fields=id,created_at&has_address=postcode,address_line&has_city=name&has_country=name').then((res) => {
                this.properties = res.data.data;
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>
