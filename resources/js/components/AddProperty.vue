<template>
    <div>
        <form action="#" @submit.prevent="submit">

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control"  v-model="form.status_id" id="status" >
                    <option></option>
                    <option v-for="status in statuses" :value="status.id">{{status.label}}</option>
                </select>
            </div>

            <AddressInputs  clear-event="clearAddress" change-event="addressChange" v-on:addressChange="addressChange" title="Property Address"/>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>
import AddressInputs from '../components/AddressInputs'

export default {
    components: {
        AddressInputs
    },
    data () {
        return {
            statuses: [],
            form: {
                status_id: '',
                address: {},
            }
        }
    },
    mounted() {
        this.fetchPropertiesStatus();
    },
    methods: {
        fetchPropertiesStatus(){
            axios.get('/api/v1/property-statuses?fields=id,label').then((res) => {
                this.statuses = res.data.data;
            }).catch((error) => {
                console.log(error)
            })
        },
        submit(){
            axios.post('/api/v1/properties', this.form).then((res) => {
                this.clearData();
            }).catch((error) => {
                console.log(error)
            })
        },
        clearData()
        {
            this.form.status_id = '';
            this.clearAddress();
        },
        clearAddress: function() {
            this.$emit('clearAddress');
        },
        addressChange(address)
        {
            this.form.address = address;
        },
    }
}
</script>
