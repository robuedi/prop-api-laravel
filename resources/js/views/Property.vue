<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
            <img class="card-img-bottom" src="" alt="Card image cap">
        </div>
    </div>
</template>

<script>

export default {
    data () {
        return {
            property: ''
        }
    },
    mounted() {
        this.fetchProperty()
    },
    methods: {
        fetchProperty() {
            axios.get('/api/v1/properties/'+this.$route.params.property_id+'?has_address=postcode,address_line&has_city=name&has_country=name&has_owner=name').then((res) => {
                this.property = res.data.data;
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>
