<template>
    <div>
        <AccountNavigation activeSection="addProperty"/>
        <NotificationLabels :errors="errors" :success="success"/>

        <form action="#" @submit.prevent="submit">

            <div class="mb-3">
                <label for="property_name" class="form-label">Property Name</label>
                <input type="text" v-model="form.property.name"  class="form-control w-50" id="property_name" >
            </div>
            <div class="form-group" >
                <label for="status">Status</label>
                <select class="form-control"  v-model="form.property.status_id" id="status" >
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
import AccountNavigation from "./partials/AccountNavigation";
import AddressInputs from '../../components/partials/AddressInputs'
import NotificationLabels from '../../components/partials/NotificationLabels'
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        AddressInputs,
        NotificationLabels,
        AccountNavigation
    },
    data () {
        return {
            success: [],
            errors: [],
            form: {
                property: {
                    name: '',
                    status_id: '',
                    address: {},
                },
            }
        }
    },
    computed: {
        ...mapGetters('propertiesStatuses',{
            statuses: 'statuses',
        }),
        ...mapGetters('userProperties',{
            userProperty: 'userProperty',
        })
    },
    mounted() {
        this.getStatuses();
    },
    methods: {
        ...mapActions('propertiesStatuses', ['getStatuses']),
        ...mapActions('userProperties', ['storeUserProperty', 'clearUserProperty']),
        ...mapActions('propertyAddress', ['storeUserPropertyAddress']),
        async submit()
        {
            this.storeUserProperty(this.form.property).then((res) => {
                this.success.push(`${res.name} property created.`);
                this.clearUserProperty()
                this.clearData()
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        },
        clearData()
        {
            this.error = [];
            this.form.property.status_id = '';
            this.form.property.name = '';
            this.form.property.address = {};
            this.$emit('clearAddress');
        },
        addressChange(address)
        {
            this.form.property.address = address;
        },
    }
}
</script>
