<template>
    <div class="card " >
        <div class="card-img-top" v-if="property.images !== 'undefined' && property.images.length > 0 " :style='`background-image: url("/${property.images[0].path}"`'></div>
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

<style scoped>
.card-img-top{
    height: 290px;
    background-position: center;
    background-size: cover;

}
</style>



