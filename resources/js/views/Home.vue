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
import PropertyItemCard from "../components/partials/PropertyItemCard";
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        PropertyItemCard
    },
    computed: {
        ...mapGetters('properties',{
            properties: 'properties',
        }),
    },
    mounted() {
        this.setPropertyIndexParams()
        this.getProperties()
    },
    methods: {
        ...mapActions('paramsPropertyIndex', [
            'setAddress',
            'setCity',
            'setFields',
            'setCountry'
        ]),
        ...mapActions('properties', ['getProperties']),
        setPropertyIndexParams()
        {
            this.setFields(['id', 'name', 'created_at'])
            this.setAddress(['postcode', 'address_line'])
            this.setCity(['name'])
            this.setCountry(['name'])
        }
    }
}
</script>
