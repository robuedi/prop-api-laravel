<template>
    <div v-if="show === true">
        <NotificationLabels :errors="errors"/>
        <form action="#" @submit.prevent="submit">
            <div class="mb-3" >
                <label for="annual_salary" class="form-label">Annual salary</label>
                <input type="text" v-model="form.amount" class="form-control w-50" id="annual_salary" >
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>
import NotificationLabels from '../../../components/NotificationLabels'
import AnnualSalary from "../../../api/models/AnnualSalary";

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
    methods: {
        async submit()
        {
            AnnualSalary.store(this.form).then((res) => {
                this.$emit('hasAnnualSalary')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        AnnualSalary.all().then((res) => {
            if(res.data.data.length !== 0) {
                this.$emit('hasAnnualSalary');
            }
            else {
                this.show = true
            }
        });
    }
}
</script>

<style scoped>

</style>
