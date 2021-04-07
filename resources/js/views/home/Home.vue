<template>
    <div>
        <h1>Properties</h1>
        <p v-if="loadingProperties">Loading properties...</p>
        <template v-else>
            <div class="card-columns" v-if="properties.length > 0">
                <PropertyItemCard v-for="property in properties" :key="property.id" :property="property"/>
            </div>
            <p v-else >No properties yet.</p>
        </template>
    </div>
</template>

<script>
import PropertyItemCard from "./partials/PropertyItemCard";
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        PropertyItemCard
    },
    data() {
        return {
            loadingProperties: true
        }
    },
    computed: {
        ...mapGetters('properties',{
            properties: 'properties',
        }),
    },
    mounted() {
        this.setPropertyIndexParams()
        this.getProperties().finally(()=>{
            this.loadingProperties = false
        })
    },
    methods: {
        ...mapActions('paramsPropertyIndex', [
            'setAddress',
            'setCity',
            'setFields',
            'setCountry',
            'setUserType'
        ]),
        ...mapActions('properties', ['getProperties']),
        setPropertyIndexParams()
        {
            this.setFields(['id', 'name', 'created_at'])
            this.setAddress(['postcode', 'address_line'])
            this.setCity(['name'])
            this.setCountry(['name'])
            this.setUserType(true)
        }
    }
}
</script>
