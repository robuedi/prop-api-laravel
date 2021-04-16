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
import NotificationLabels from "../components/NotificationLabels";
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
        ...mapActions('auth', ['signIn', 'setActiveRole']),
        async submit () {
            await this.signIn(this.form).then((res)=>{
                //no roles, make one
                if(this.user.user_role.length === 0)
                {
                    this.$router.push({name: 'chooseRoles'})
                    return;
                }

                //check if only one active if it has many
                let activeRoles = this.user.user_role.filter(userRole => userRole.is_completed === 1);

                //one active role found -> go to it
                if(activeRoles.length === 1 && this.user.user_role.length === 1)
                {
                    this.setActiveRole(activeRoles[0])
                    this.$router.push({name: 'accountProfile'})
                }
                else
                {
                    this.$router.push({name: 'chooseRoles'})
                }

            }).catch((err) => {
                for (const [key, msg] of Object.entries(err.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            })
        },
    }
}
</script>




