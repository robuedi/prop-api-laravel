<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <router-link class="nav-link" :to="{ name: 'home' }">Home</router-link>
                    </li>

                    <template v-if="!authenticated">
                        <li class="nav-item dropdown">
                            <router-link class="nav-link" :to="{ name: 'signIn' }">Sign In</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <router-link class="nav-link" :to="{ name: 'register' }">Register</router-link>
                        </li>
                    </template>
                    <template v-else>
                        <router-link class="nav-link" to="/account"  >{{ user.name }}</router-link>
                        <a href="#" class="nav-link" @click.prevent="signOut" >Sign out</a>
                    </template>
<!--                    <li class="nav-item dropdown">-->
<!--                        <router-link :to="/account">Alex Garrett-Smith</router-link>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        })
    },
    methods: {
        ...mapActions('auth', {
            signOutAction: 'signOut'
        }),
        async signOut () {
            await this.signOutAction()

            this.$router.replace({ name: 'home' })
        }
    }
}
</script>
