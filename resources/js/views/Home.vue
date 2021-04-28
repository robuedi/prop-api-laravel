<template>
    <div>
        <h1>Properties</h1>
        <p v-if="loadingProperties">Loading properties...</p>
        <template v-else>
            <div class="card-columns" v-if="properties.length > 0">
                <PropertyItemCard v-for="property in properties" :key="property.slug" :property="property"/>
            </div>
            <p v-else >No properties yet.</p>
        </template>
    </div>
</template>

<script>
import PropertyItemCard from "../components/home/PropertyItemCard";
import QueryBuilder from "../api/QueryBuilder";
import Property from "../api/models/Property";

export default {
    components: {
        PropertyItemCard
    },
    data() {
        return {
            loadingProperties: true,
            properties: []
        }
    },
    mounted() {
        //make the query string
        const query = new QueryBuilder();
        query.setInclude(['address', 'address.city', 'address.city.country', 'images'])
        query.setFields('properties', ['id', 'name', 'slug', 'created_at'])
        query.setFields('address', ['id', 'property_id', 'city_id', 'postcode', 'address_line'])
        query.setFields('address.city', ['id', 'country_id', 'name'])
        query.setFields('address.city.country', ['id', 'name'])
        query.setFields('images', [ 'path'])

        //fetch data
        Property.all(query.get()).then((res) => {
            this.properties = res.data.data
        }).finally(()=>{
            this.loadingProperties = false
        })
    },
}
</script>
