<template>
    <div v-if="show === true">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" v-for="error in errors">
            {{ error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" @submit.prevent="submit">
            <AddressInputs title="Address" v-on:addressCompleted="addressCompleted" change-event="addressCompleted"/>

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
        ...mapGetters('userAddress',{
            userAddress: 'userAddress',
        })
    },
    methods:{
        addressCompleted(address){
            this.currentAddress = address;
        },
        ...mapActions('userAddress', ['setUserAddress', 'getCurrentUserAddress']),
        async submit()
        {
            this.setUserAddress(this.currentAddress).then((res) => {
                this.$emit('hasAddress')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        this.getCurrentUserAddress().then((res) => {
            if(this.userAddress.length !== 0)
            {
                this.$emit('hasAddress');
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
