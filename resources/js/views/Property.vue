<template>
    <div class="card" v-if="property">
        <img class="card-img-top" src="https://i.stack.imgur.com/y9DpT.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{cityName+', '+countryName}}</h5>
            <p class="card-text">
                <span class="badge badge-primary">{{statusLabel}}</span>
            </p>
            <p class="card-text" v-if="propertyAddress">
                {{propertyAddress.address_line+', '+propertyAddress.postcode}}
            </p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
</template>

<script>

import { mapActions, mapGetters } from 'vuex'

export default {
    data(){
        return {
            propertyCity: null
        }
    },
    computed: {
        ...mapGetters('properties',{
            property: 'property',
            propertyAddress: 'propertyAddress'
        }),
        ...mapGetters('propertiesStatuses',{
            statuses: 'statuses'
        }),
        ...mapGetters('cities',{
            cities: 'cities'
        }),
        ...mapGetters('countries',{
            countries: 'countries'
        }),
        statusLabel() {
            let status = this.statuses.find(item => item.id === this.property.status_id)
            if(status){
                return status.label
            }
        },
        city() {
            let city = this.cities.find(item => item.id === this.propertyAddress.city_id)
            if(city){
                return city
            }
        },
        cityName(){
            if(!this.city)
            {
                return '';
            }
            return this.city.name;
        },
        cityId(){
            if(!this.city)
            {
                return '';
            }
            return this.city.id;
        },
        countryName() {
            let country = this.countries.find(item => item.id === this.cityId)
            if(country){
                return country.name
            }
            return ''
        }
    },
    mounted() {
        this.getStatuses();
        this.showProperty(this.$route.params.property_id)
        this.showPropertyAddress(this.$route.params.property_id).then(() => {
            this.getCities();
            this.getCountries();
        });
    },
    methods: {
        ...mapActions('properties', ['showProperty', 'showPropertyAddress']),
        ...mapActions('propertiesStatuses', ['getStatuses']),
        ...mapActions('cities', ['getCities']),
        ...mapActions('countries', ['getCountries']),
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
