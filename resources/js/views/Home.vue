<template>
    <div>
        <h1>Properties</h1>
        <div class="card-deck" v-if="properties">
            <div class="card" v-for="property in properties">
                <img class="card-img-top" src="https://loremflickr.com/320/240/house" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{property.created_at}}</h5>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            properties: [],
        }
    },
    mounted() {
        this.fetchProperties();
    },
    methods: {
        fetchProperties(){
            axios.get('/api/v1/properties?fields=status_id,created_at').then((res) => {
                this.properties = res.data.data;
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>
