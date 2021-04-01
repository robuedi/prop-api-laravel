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
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        AddressInputs
    },
    data () {
        return {
            form: {
                status_id: '',
                address: {},
            }
        }
    },
    computed: {
        ...mapGetters('propertiesStatuses',{
            statuses: 'statuses',
        })
    },
    mounted() {
        this.getStatuses();
    },
    methods: {
        ...mapActions('propertiesStatuses', ['getStatuses']),
        ...mapActions('properties', ['setProperty']),
        async submit()
        {
            this.setProperty(this.form).then((res) => {
                this.clearData()
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
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
