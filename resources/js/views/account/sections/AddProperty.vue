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
                    <option v-for="status in statuses" :value="status.id">{{status.name}}</option>
                </select>
            </div>

            <AddressInputs  clear-event="clearAddress" change-event="addressChange" v-on:addressChange="addressChange" title="Property Address"/>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>

import rolePropertyType from "./rolePropertyType";
import AccountNavigation from "../layout/AccountNavigation";
import AddressInputs from '../../../components/AddressInputs'
import NotificationLabels from '../../../components/NotificationLabels'
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        AddressInputs,
        NotificationLabels,
        AccountNavigation
    },
    data () {
        return {
            rolePropertyType: null,
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
        ...mapGetters('auth', {
            activeRole: 'activeRole',
        }),
    },
    mounted() {
        this.rolePropertyType = rolePropertyType
        this.getStatuses();
    },
    methods: {
        ...mapActions('propertiesStatuses', ['getStatuses']),
        ...mapActions('properties', ['storeUserProperty']),
        ...mapActions('propertyAddress', ['storeUserPropertyAddress']),
        async submit()
        {
            this.storeUserProperty(this.prepareFormData()).then((res) => {
                this.success.push(`${res.name} property created.`);
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
        prepareFormData()
        {
            //add the property type based on the role
            return {...this.form.property, type_id:this.rolePropertyType[this.activeRole.role_id].propertyType}
        },
        addressChange(address)
        {
            this.form.property.address = address;
        },
    }
}
</script>
