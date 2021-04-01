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
                <label for="current_rent_amount" class="form-label">Current rent amount</label>
                <input type="text" v-model="form.amount" class="form-control w-50" id="current_rent_amount" >
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
                amount: null,
            },
        }
    },
    computed: {
        ...mapGetters('rent',{
            rent: 'rent',
        })
    },
    methods: {
        ...mapActions('rent', ['setRent']),
        ...mapActions('rent', ['getCurrentUserRent']),
        async submit()
        {
            this.setRent(this.form).then((res) => {
                this.$emit('hasRent')
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        this.getCurrentUserRent().then((res) => {
            if(this.rent.length !== 0)
            {
                this.$emit('hasRent');
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
