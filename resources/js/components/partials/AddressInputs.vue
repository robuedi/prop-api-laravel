<template>
    <div>
        <h5 class="mb-2">{{ title }}</h5>
        <div class="form-group">
            <label for="countries">Country</label>
            <select class="form-control"  v-model="selectedCountry" id="countries" v-on:change="fetchCities(selectedCountry)">
                <option></option>
                <option v-for="country in countries" :value="country.id">{{country.name}}</option>
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
        this.fetchCountries();
    },
    methods: {
        fetchCountries(){
            axios.get('/api/v1/countries?fields=id,name').then((res) => {
                this.countries = res.data.data;
            }).catch((error) => {
                throw error
            })
        },
        fetchCities(countryId)
        {
            axios.get(`/api/v1/cities?where_country_id=${countryId}&fields=id,name`).then((res) => {
                this.cities = res.data.data;
            }).catch((error) => {
                throw error
            })
        },
        addressUpdated()
        {
            if(this.form.city_id !== '' && this.form.address_line !== '' && this.form.postcode !== '' && this.changeEvent !== '')
            {
                this.$emit(this.changeEvent, this.form)
            }
        },
        clearValues(){
            this.form.city_id = '';
            this.form.address_line = '';
            this.form.postcode = '';
            this.selectedCountry = '';
        }
    },
    created() {
        if(this.clearEvent!== '')
        {
            this.$parent.$on(this.clearEvent, this.clearValues);
        }
    }
}
</script>




