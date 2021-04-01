<template>
    <div>
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

import AddressInputs from '../AddressInputs'
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        AddressInputs
    },
    data(){
        return {
            errors: [],
            currentAddress: ''
        }
    },
    computed: {
        ...mapGetters('agencyAddress',{
            address: 'agencyAddress',
        }),
        ...mapGetters('agencyInfo',{
            agency: 'agency',
        })
    },
    methods:{
        addressCompleted(address){
            this.currentAddress = address;
        },
        ...mapActions('agencyAddress', ['setAgencyAddress', 'getAgencyAddress']),
        async submit()
        {
            console.log(this.currentAddress);
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
        });
    }
}
</script>

<style scoped>

</style>
