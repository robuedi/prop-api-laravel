<template>
    <div>
        <AccountNavigation activeSection="addProperty"/>
        <NotificationLabels :errors="errors" :success="success"/>

        <form action="#" @submit.prevent="submit">

            <div class="mb-3">
                <label for="property_name" class="form-label">Property Name</label>
                <input type="text" v-model="form.name"  class="form-control w-50" id="property_name" >
            </div>
            <div class="form-group" >
                <label for="status">Status</label>
                <select class="form-control"  v-model="form.status_id" id="status" >
                    <option></option>
                    <option v-for="status in statuses" :value="status.id">{{status.name}}</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="media_file" class="form-label">Property Image</label>
                <br/>
                <input type="file" id="media_file" @change="selectImage">
            </div>

            <AddressInputs  clear-event="clearAddress" change-event="addressChange" v-on:addressChange="addressChange" title="Property Address"/>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>

import AccountNavigation from "../../layout/account/AccountNavigation";
import AddressInputs from '../../components/AddressInputs'
import NotificationLabels from '../../components/NotificationLabels'
import {mapActions, mapGetters} from "vuex";
import RoleUserProperty from "../../api/models/RoleUserProperty";

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
                media_file: null,
                name: '',
                status_id: '',
                address: {},
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
        this.getStatuses();
    },
    methods: {
        ...mapActions('propertiesStatuses', ['getStatuses']),
        ...mapActions('propertyAddress', ['storeUserPropertyAddress']),
        async submit()
        {
            //make form data
            const formData = new FormData();

            //build form data
            this.buildFormData(formData, this.form);

            RoleUserProperty.store(this.activeRole.id, formData).then((res) => {
                this.success.push(`${res.data.data.name} property created.`);
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
            this.form.status_id = '';
            this.form.name = '';
            this.form.address = {};
            this.$emit('clearAddress');
        },
        selectImage(event){
            this.form.media_file = event.target.files[0];
        },
        addressChange(address)
        {
            this.form.address = address;
        },
    }
}
</script>
