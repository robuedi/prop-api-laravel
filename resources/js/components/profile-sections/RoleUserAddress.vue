<template>
    <div v-if="show === true">

        <NotificationLabels :errors="errors"/>

        <form action="#" @submit.prevent="submit">
            <AddressInputs title="Address" v-on:addressCompleted="addressCompleted" change-event="addressCompleted"/>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>

import NotificationLabels from "../NotificationLabels";
import AddressInputs from '../AddressInputs'
import RoleUserAddress from "../../api/models/RoleUserAddress";

export default {
    props: {
        roleUserId: Number
    },
    components: {
        AddressInputs,
        NotificationLabels
    },
    data(){
        return {
            show: false,
            errors: [],
            currentAddress: ''
        }
    },
    methods:{
        addressCompleted(address){
            this.currentAddress = address;
        },
        async submit()
        {
            RoleUserAddress.store(this.roleUserId, this.currentAddress).then((res) => {
                this.$emit('hasAddress', res)
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        RoleUserAddress.all(this.roleUserId).then((res) => {
            if(res.data.data.length !== 0)
            {
                this.$emit('hasAddress', res);
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
