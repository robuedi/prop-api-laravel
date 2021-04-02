<template>
    <div class="card " >
        <img class="card-img-top" src="https://loremflickr.com/320/240/house" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{property.name}}</h5>
            <p class="card-text">
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
        }
    }
}
</script>




