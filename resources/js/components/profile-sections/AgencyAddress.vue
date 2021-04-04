<template>
    <div v-if="show === true">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" v-for="error in errors">
            {{ error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" @submit.prevent="submit">
            <AddressInputs title="Agency Address" v-on:addressCompleted="addressCompleted" change-event="addressCompleted"/>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>

import AddressInputs from '../partials/AddressInputs'
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        AddressInputs
    },
    data(){
        return {
            show: false,
            errors: [],
            currentAddress: ''
        }
    },
    computed: {
        ...mapGetters('userAgencyAddress',{
            address: 'agencyAddress',
        }),
        ...mapGetters('userAgencies',{
            agency: 'agency',
        })
    },
    methods:{
        addressCompleted(address){
            this.currentAddress = address;
        },
        ...mapActions('userAgencyAddress', ['setAgencyAddress', 'getAgencyAddress']),
        async submit()
        {
            this.setAgencyAddress({'agencyId':this.agency.id, 'address':this.currentAddress}).then((res) => {
                this.$emit('hasAgencyAddress')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        this.getAgencyAddress(this.agency.id).then((res) => {
            if(this.address.length !== 0)
            {
                this.$emit('hasAgencyAddress');
            }
            else
            {
                this.show = true
            }
        });
    }
}
</script>

<style scoped>

</style>
