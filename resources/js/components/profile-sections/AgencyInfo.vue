<template>
    <div v-if="show === true">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" v-for="error in errors">
            {{ error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" @submit.prevent="submit">
            <div class="mb-3" >
                <label for="agency_name" class="form-label">Agency name</label>
                <input type="text" v-model="form.name" class="form-control w-50" id="agency_name" >
            </div>
            <div class="form-check mb-3">
                <input type="checkbox"  v-model="form.is_public" class="form-check-input" id="is_public">
                <label class="form-check-label" for="is_public">Keep the agency private?</label>
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
            show: false,
            errors: [],
            form: {
                name: null,
                is_public: null,
            },
        }
    },
    computed: {
        ...mapGetters('agencyInfo',{
            agency: 'agency',
        })
    },
    methods: {
        ...mapActions('agencyInfo', ['setAgency']),
        ...mapActions('agencyInfo', ['getCurrentUserAgency']),
        async submit()
        {
            this.setAgency(this.form).then((res) => {
                this.$emit('hasAgencyInfo')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        this.getCurrentUserAgency().then((res) => {
            if(this.agency.length !== 0)
            {
                this.$emit('hasAgencyInfo');
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
