<template>
    <div class="card" v-if="property">
        <div class="card-img-top" v-if="property.images !== 'undefined' && property.images.length > 0 " :style='`background-image: url("/${property.images[0].path}"`' alt="Card image cap"></div>
        <div class="card-body">
            <h5 class="card-title mb-4">{{property.name}}</h5>
            <button type="button" @click="bookProperty()" class="btn btn-primary mb-4">{{ 'property.type.name' | capitalize }}</button>
            <div class="card-text">
                <p>
                    <strong>{{ property.address.city.name+', '+property.address.city.country.name }}</strong>
                    <br/>
                    <small>{{property.address.address_line+', '+property.address.postcode}}</small>
                    <br/>
                    <span class="float-right">Added on {{property.created_at | date}}</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'
import QueryBuilder from "../api/QueryBuilder";
import PropertyApplications from "../api/models/PropertyApplications";
import Property from "../api/models/Property";

export default {
    computed: {
        ...mapGetters('auth', {
            activeRole: 'activeRole',
        }),
    },
    data: () => {
        return {
            property: null
        }
    },
    mounted() {
        Property.showSlug(this.$route.params.propertySlug, this.getQueryString()).then((res)=>{
            this.property = res.data.data
        })
    },
    methods: {
        bookProperty()
        {
            console.log(this.property)
            PropertyApplications.store(this.activeRole.id,{property_id: this.property.id}).then(()=>{
                console.log('success')
            })
        },
        getQueryString() {
            const query = new QueryBuilder();
            query.setInclude(['address', 'address.city', 'address.city.country', 'images'])
            query.setFields('properties', ['id', 'name', 'slug', 'created_at'])
            query.setFields('address', ['id', 'property_id', 'city_id', 'postcode', 'address_line'])
            query.setFields('address.city', ['id', 'country_id', 'name'])
            query.setFields('address.city.country', ['id', 'name'])
            query.setFields('images', ['path'])

            return query.get()
        }
    }
}
</script>

<style scoped>
.badge {
    font-size: 16px;
}
.card-img-top{
    height: 350px;
    background-position: center;
    background-size: cover;

}
</style>
