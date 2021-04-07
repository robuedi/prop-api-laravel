<template>
    <div class="card" v-if="property">
        <img class="card-img-top" src="https://i.stack.imgur.com/y9DpT.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title mb-4">{{property.name}}</h5>
            <button type="button" @click="bookProperty(property.id)" class="btn btn-primary mb-4">{{ property.type.name | capitalize }}</button>
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
        this.showProperty({propertyId:this.$route.params.property_id, query: 'has_address=true&has_type=true'})
    },
    methods: {
        ...mapActions('properties', ['showProperty']),
        ...mapActions('propertyUser', ['bookProperty']),
        bookProperty(propertyId)
        {
            this.bookProperty({property_id: propertyId, user_id: user.id}).then(()=>{
                console.log('success')
            })
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
