<template>
    <div>
        <h1 class="mb-4">Register</h1>

        <!-- Step 0 -->
<!--        <template v-if="!form.type_id">-->
<!--            <button type="button" v-for="userType in userTypes" @click="setUserType(userType.id)" class="btn btn-outline-dark btn-lg btn-block">-->
<!--                {{ userType.label }}-->
<!--            </button>-->
<!--        </template>-->
<!--        <template v-else>-->
<!--            <button type="button" class="btn btn-sm btn-outline-dark mb-4" @click="backToUserType()">Back</button>-->
<!--        </template>-->

        <template >
            <form action="#" @submit.prevent="submit">

                <NotificationLabels :errors="errors"/>

                <div class="mb-3" >
                    <label for="name" class="form-label">Name</label>
                    <input type="text" v-model="form.name" class="form-control w-50" id="name" >
                </div>

                <div class="mb-3" >
                    <label for="InputEmail" class="form-label">Email address</label>
                    <input type="email" v-model="form.email" class="form-control w-50" id="InputEmail" >
                </div>

                <div class="mb-3" >
                    <label for="dob" class="form-label">Date of birth</label>
                    <input type="string" placeholder="day/month/year" v-model="form.dob" class="form-control w-50" id="dob" >
                </div>

                <div class="mb-3" >
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control w-50" v-model="form.password" id="InputPassword">
                </div>

                <div class="mb-3" >
                    <label for="InputPassword2" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control w-50" v-model="form.password_confirmation" id="InputPassword2">
                </div>

                <button class="btn btn-success">Submit</button>

            </form>
        </template>
    </div>
</template>

<script>
import AddressInputs from '../components/partials/AddressInputs'
import NotificationLabels from "../components/partials/NotificationLabels";

import { mapActions } from 'vuex'

export default {
    components: {
        AddressInputs,
        NotificationLabels
    },
    data () {
        return {
            errors: [],
            form: {
                name: '',
                email: '',
                type_id: '',
                password: '',
                password_confirmation: '',
                dob: '',
            },
            requiredFields: {
                'name': 'Name',
                'email': 'Email',
                'password': 'Password',
                'dob': 'Date of birth'
            }
        }
    },
    methods: {
        ...mapActions('auth', ['register']),
        checkFieldsCompleted()
        {
            this.errors = [];

            //check if fields left unchecked
            for (const [key, label] of Object.entries(this.requiredFields)) {
                if(this.form[key] === ''){
                    this.errors.push(`${label} field is required`);
                }
            }

            //password check
            if(this.form.password_confirmation !== this.form.password)
            {
                this.errors.push(`Password confirmation field must match password.`);
            }
        },
        async submit () {
            //check if fields are ok
            this.checkFieldsCompleted();

            if(this.errors.length === 0)
            {
                this.register(this.form).then((res)=>{
                    this.$router.replace({name: 'signIn'})
                }).catch((error) => {
                    for (const [key, msg] of Object.entries(error.response.data.errors)) {
                        this.errors.push(msg[0]);
                    }
                })
            }
        }
    }
}
</script>





