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
                <label for="job_title" class="form-label">Job title</label>
                <input type="text" v-model="form.job_title" class="form-control w-50" id="job_title" >
            </div>
            <div class="mb-3" >
                <label for="start_date" class="form-label">Start date </label>
                <input type="date" v-model="form.start_date" class="form-control w-50" id="start_date" >
            </div>
            <div class="mb-3" >
                <label for="end_date" class="form-label">End date</label>
                <input type="date" v-model="form.end_date" class="form-control w-50" id="end_date" >
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
                job_title: null,
                start_date: null,
                end_date: null,
            },
        }
    },
    computed: {
        ...mapGetters('userEmployment',{
            employment: 'employment',
        })
    },
    methods: {
        ...mapActions('userEmployment', ['setEmployment']),
        ...mapActions('userEmployment', ['getCurrentUserEmployment']),
        async submit()
        {
            this.setEmployment(this.form).then((res) => {
                this.$emit('hasEmployment')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        this.getCurrentUserEmployment().then((res) => {
            if(this.employment.length !== 0)
            {
                this.$emit('hasEmployment');
            }

        });
    }
}
</script>

<style scoped>

</style>
