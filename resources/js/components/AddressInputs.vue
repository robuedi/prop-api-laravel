<template>
    <div>
        <h5 class="mb-2">{{ title }}</h5>
        <div class="form-group">
            <label for="countries">Country</label>
            <select class="form-control"  v-model="selectedCountry" id="countries" v-on:change="updateCities()">
                <option></option>
                <option v-for="country in countries" :value="country.name">{{country.name}}</option>
            </select>
        </div>
        <div class="form-group" v-if="selectedCountry" >
            <label for="cities">City</label>
            <select class="form-control"  v-model="form.city_id" id="cities" @change="addressUpdated()">
                <option></option>
                <option v-for="city in cities" :value="city.id">{{city.name}}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="address_line" class="form-label">Address Line</label>
            <input type="text" v-model="form.address_line" @change="addressUpdated()" class="form-control w-50" id="address_line" >
        </div>
        <div class="mb-3">
            <label for="postcode" class="form-label">Postcode</label>
            <input type="text" v-model="form.postcode" @change="addressUpdated()" class="form-control w-50" id="postcode" >
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import QueryBuilder from "../api/QueryBuilder";

export default {
    props: {
        title: String,
        changeEvent: String,
        clearEvent: String
    },
    data () {
        return {
            countries: [],
            cities: [],
            selectedCountry: '',
            form: {
                city_id: '',
                address_line: '',
                postcode: ''
            }
        }
    },
    mounted() {
        this.getCountries(this.makeQueryString()).then((res) => {
             this.countries = res
        })
    },
    methods: {
        ...mapActions('countries', ['getCountries']),
        addressUpdated(){
            if(this.form.city_id !== '' && this.form.address_line !== '' && this.form.postcode !== '' && this.changeEvent !== '') {
                this.$emit(this.changeEvent, this.form)
            }
        },
        updateCities(){
            let currentCountry = this.countries.filter(country => country.name === this.selectedCountry)
            this.cities = currentCountry.length === 1 ? currentCountry.shift().cities : [];
        },
        clearValues(){
            this.form.city_id = '';
            this.form.address_line = '';
            this.form.postcode = '';
            this.selectedCountry = '';
        },
        makeQueryString() {
            const query = new QueryBuilder();
            query.setInclude(['cities'])
            query.setFields('countries', ['id', 'name'])
            query.setFields('cities', ['id', 'country_id', 'name'])

            return query.get()
        }
    },
    created() {
        if(this.clearEvent!== '') {
            this.$parent.$on(this.clearEvent, this.clearValues);
        }
    }
}
</script>




