<template>
    <div v-if="show === true">

        <NotificationLabels :errors="errors"/>

        <form action="#" @submit.prevent="submit">
            <div class="mb-3" >
                <label for="current_rent_amount" class="form-label">Current rent amount</label>
                <input type="text" v-model="form.amount" class="form-control w-50" id="current_rent_amount" >
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>

import NotificationLabels from "../NotificationLabels";
import Rent from "../../api/models/Rent";

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
            Rent.store(this.roleUserId, this.form).then((res) => {
                this.$emit('hasRent', res)
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        Rent.all(this.roleUserId).then((res) => {
            if(res.data.data.length !== 0)
            {
                this.$emit('hasRent', res);
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
