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

import NotificationLabels from "../../../components/NotificationLabels";
import {mapActions, mapGetters} from "vuex";

export default {
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
    computed: {
        ...mapGetters('savings',{
            savings: 'savings',
        })
    },
    methods: {
        ...mapActions('savings', ['setSavings']),
        ...mapActions('savings', ['getCurrentUserSavings']),
        async submit()
        {
            this.setSavings(this.form).then((res) => {
                this.$emit('hasSavings')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        this.getCurrentUserSavings().then((res) => {
            if(this.savings.length !== 0)
            {
                this.$emit('hasSavings');
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
