<template>
    <div class="card " @click="redirectToProperty">
        <img class="card-img-top" src="https://i.stack.imgur.com/y9DpT.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{property.name}}</h5>
            <p class="card-text">
                {{property.address.city.country.name+', '+property.address.city.name}}
                {{property.address.address_line}}
                <br/>
                <span class="float-right">Added on: {{formatDate(property.created_at)}}</span>
            </p>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    props: {
        property: Object
    },
    methods: {
        formatDate: function (date) {
            return moment(date).format('YYYY-MM-DD');
        },
        redirectToProperty() {
            this.$router.push({path: '/property/'+this.property.id})
        }
    }
}
</script>




