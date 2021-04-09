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
import {mapActions, mapGetters} from "vuex";

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
    computed: {
        ...mapGetters('countries',{
            loadedCountries: 'countries',
        })
    },
    mounted() {
        this.loadCountries()
    },
    methods: {
        ...mapActions('countries', ['getCountries']),
        loadCountries()
        {
            if(this.loadedCountries.length > 0) {
                this.countries = this.loadedCountries;
            }
            else{
                this.getCountries().then((res) => {
                    this.countries = res.data.data;
                }).catch((error) => {
                    throw error
                })
            }
        },
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
        }
    },
    created() {
        if(this.clearEvent!== '') {
            this.$parent.$on(this.clearEvent, this.clearValues);
        }
    }
}
</script>




