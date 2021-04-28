<template>
    <div v-if="show === true">

        <NotificationLabels :errors="errors"/>

        <form action="#" @submit.prevent="submit">
            <div class="mb-3" >
                <label for="savings" class="form-label">Total savings available for a deposit</label>
                <input type="text" v-model="form.amount" class="form-control w-50" id="savings" >
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>

import NotificationLabels from "../NotificationLabels";
import Saving from "../../api/models/Saving";

export default {
    props: {
        roleUserId: Number
    },
    components: {
        NotificationLabels
    },
    data () {
        return {
            show: false,
            errors: [],
            form: {
                amount: null,
            },
        }
    },
    methods: {
        async submit()
        {
            Saving.store(this.roleUserId, this.form).then((res) => {
                this.$emit('hasSavings', res)
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        Saving.all(this.roleUserId).then((res) => {
            if(res.data.data.length !== 0){
                this.$emit('hasSavings', res);
            }
            else{
                this.show = true
            }
        });
    }
}
</script>

<style scoped>

</style>
