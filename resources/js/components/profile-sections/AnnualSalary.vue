<template>
    <div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" v-for="error in errors">
            {{ error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
import {mapActions, mapGetters} from "vuex";

export default {
    data () {
        return {
            errors: [],
            form: {
                amount: null,
            },
        }
    },
    computed: {
        ...mapGetters('annualSalary',{
            annualSalary: 'annualSalary',
        })
    },
    methods: {
        ...mapActions('annualSalary', ['setAnnualSalary']),
        ...mapActions('annualSalary', ['getCurrentUserAnnualSalary']),
        async submit()
        {
            this.setAnnualSalary(this.form).then((res) => {
                this.$emit('hasAnnualSalary')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        this.getCurrentUserAnnualSalary().then((res) => {
            if(this.annualSalary.length !== 0)
            {
                this.$emit('hasAnnualSalary');
            }
        });
    }
}
</script>

<style scoped>

</style>
