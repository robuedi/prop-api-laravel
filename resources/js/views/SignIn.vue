<template>
    <div>
        <h1>Sign In</h1>
        <NotificationLabels :errors="errors"/>
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
import NotificationLabels from "../components/partials/NotificationLabels";
import {mapActions, mapGetters} from 'vuex'

export default {
    components: {
        NotificationLabels
    },
    data () {
        return {
            errors: [],
            form: {
                email: '',
                password: '',
            }
        }
    },
    computed: {
        ...mapGetters('auth', ['user'])
    },
    methods: {
        ...mapActions('auth', ['signIn']),
        async submit () {
            await this.signIn(this.form).then((res)=>{
                setTimeout(()=> {
                    this.checkUserStatus();
                }, 500)
            }).catch((err) => {
                for (const [key, msg] of Object.entries(err.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            })
        },
        checkUserStatus()
        {
            if(this.user.is_completed === 0)
            {
                this.$router.replace({name: 'completeRegister'})
            }
            else
            {
                this.$router.replace({name: 'account'})
            }
        }
    }
}
</script>




