<template>
    <div class="card" v-if="property">
        <img class="card-img-top" src="https://i.stack.imgur.com/y9DpT.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title mb-4">{{property.name}}</h5>
            <button type="button" @click="bookProperty(property.slug)" class="btn btn-primary mb-4">{{ property.type.name | capitalize }}</button>
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

import { mapActions, mapGetters } from 'vuex'
import QueryBuilder from "../api/QueryBuilder";

export default {
    computed: {
        ...mapGetters('properties',{
            property: 'property',
        }),
        ...mapGetters('auth',{
            user: 'user',
        }),
    },
    mounted() {
        this.showSlugProperty({slug:this.$route.params.propertySlug, query: this.makeQueryString()})
    },
    methods: {
        ...mapActions('properties', ['showSlugProperty']),
        ...mapActions('propertyUser', ['bookProperty']),
        bookProperty(propertySlug)
        {
            this.bookProperty({property_slug: propertySlug, user_id: user.id}).then(()=>{
                console.log('success')
            })
        },
        makeQueryString() {
            const query = new QueryBuilder();
            query.setInclude(['address', 'address.city', 'address.city.country', 'type'])
            query.setFields('properties', ['id', 'name', 'type_id', 'slug', 'created_at'])
            query.setFields('address', ['id', 'property_id', 'city_id', 'postcode', 'address_line'])
            query.setFields('address.city', ['id', 'country_id', 'name'])
            query.setFields('address.city.country', ['id', 'name'])
            query.setFields('type', ['id', 'name'])

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
    max-height: 250px;
}
</style>
