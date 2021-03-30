<template>
    <div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control"  v-model="form.status" id="status" >
                <option></option>
                <option v-for="status in statuses" :value="status.id">{{status.label}}</option>
            </select>
        </div>

        <AddressInputs />
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
                status: '',
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
    }
}
</script>
