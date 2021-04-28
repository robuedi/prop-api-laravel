<template>
    <div >
        <template v-if="show === true">
            <NotificationLabels :errors="errors"/>
            <form action="#" @submit.prevent="submit">
                <AddressInputs title="Agency Address" v-on:addressCompleted="addressCompleted" change-event="addressCompleted"/>

                <button class="btn btn-success">Submit</button>
            </form>
        </template>
        <p v-else>Loading..</p>
    </div>
</template>

<script>

import NotificationLabels from '../NotificationLabels'
import AddressInputs from '../AddressInputs'
import AgencyAddress from "../../api/models/AgencyAddress";

export default {
    components: {
        AddressInputs,
        NotificationLabels
    },
    props: {
        agencyId: Number
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
            AgencyAddress.store(this.agencyId, this.currentAddress).then((res) => {
                this.$emit('hasAgencyAddress')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        AgencyAddress.all(this.agencyId).then((res) => {
            if(res.data.data.length !== 0)
            {
                this.$emit('hasAgencyAddress', res.data.data);
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
