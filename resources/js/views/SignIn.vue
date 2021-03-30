<template>
    <div>
        <h1>Sign In</h1>
        <form action="#" @submit.prevent="submit">
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input type="email" v-model="form.email" class="form-control w-50" id="InputEmail" >
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" class="form-control w-50" v-model="form.password" id="InputPassword">
            </div>
            <button type="submit" class="btn btn-primary"> Sign in</button>
        </form>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    data () {
        return {
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        ...mapActions('auth', ['signIn']),
        async submit () {
            await this.signIn(this.form)

            await this.$router.replace({name: 'account'})
        }
    }
}
</script>




