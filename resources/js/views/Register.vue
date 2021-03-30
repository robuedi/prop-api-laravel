<template>
    <div>
        <h1 class="mb-4">Register</h1>

        <!-- Step 0 -->
        <template v-if="!form.userType">
            <button type="button" @click="setUserType('tenant')" class="btn btn-outline-dark btn-lg btn-block">Tenant</button>
            <button type="button" @click="setUserType('buyer')" class="btn btn-outline-dark btn-lg btn-block">Buyer</button>
            <button type="button" @click="setUserType('landlord')" class="btn btn-outline-dark btn-lg btn-block">Landlord</button>
            <button type="button" @click="setUserType('seller')" class="btn btn-outline-dark btn-lg btn-block">Seller</button>
        </template>
        <template v-else>
            <button type="button" class="btn btn-sm btn-outline-dark mb-4" @click="clearUserType()">Back</button>
        </template>

        <template v-if="form.userType">
            <form action="#" @submit.prevent="submit">

                <!-- Step 1 -->
                <template v-if="formStep === 1">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" v-model="form.name" class="form-control w-50" id="name" >
                    </div>
                    <div class="mb-3">
                        <label for="InputEmail" class="form-label">Email address</label>
                        <input type="email" v-model="form.email" class="form-control w-50" id="InputEmail" >
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of birth</label>
                        <input type="date" v-model="form.dob" class="form-control w-50" id="dob" >
                    </div>
                    <div class="mb-3">
                        <label for="InputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control w-50" v-model="form.password" id="InputPassword">
                    </div>
                </template>

                <!-- Step 2 -->
                <div class="mb-3" v-if="checkIfFieldStatus('annual_salary')">
                    <label for="annual_salary" class="form-label">Annual salary</label>
                    <input type="text" v-model="form.annual_salary" class="form-control w-50" id="annual_salary" >
                </div>
                <div class="mb-3" v-if="checkIfFieldStatus('current_rent_amount')">
                    <label for="current_rent_amount" class="form-label">Current rent amount</label>
                    <input type="text" v-model="form.current_rent_amount" class="form-control w-50" id="current_rent_amount" >
                </div>
                <div class="mb-3" v-if="checkIfFieldStatus('total_deposit_savings')">
                    <label for="total_deposit_savings" class="form-label">Total savings available for a deposit</label>
                    <input type="text" v-model="form.total_deposit_savings" class="form-control w-50" id="total_deposit_savings" >
                </div>
                <div class="mb-3" v-if="checkIfFieldStatus('agency_name')">
                    <label for="agency_name" class="form-label">Agency name</label>
                    <input type="text" v-model="form.agency_name" class="form-control w-50" id="agency_name" >
                </div>

                <AddressInputs title="Agency address" v-if="checkIfFieldStatus('agency_address')"/>
                <AddressInputs title="Address" v-if="checkIfFieldStatus('address')"/>

                <button v-if="!checkIfLastStep()" type="button" @click="setRegistrationStep(++formStep)" class="btn btn-outline-dark">Next</button>
                <button v-else type="button" class="btn btn-success">Submit</button>

            </form>
        </template>
    </div>
</template>

<script>
import AddressInputs from '../components/AddressInputs'

import { mapActions } from 'vuex'

export default {
    components: {
        AddressInputs
    },
    data () {
        return {
            formStep: 0,
            form: {
                name: '',
                email: '',
                userType: '',
                password: '',
                dob: '',
                annual_salary: '',
                current_rent_amount: '',
                total_deposit_savings: '',
                agency_name: '',
                agency_address: {},
                address: {}
            },
            requiredFields: {
                tenant: {
                    2: {
                        'address': true
                    },
                    3 : {
                        'annual_salary': true,
                        'current_rent_amount':true
                    }
                },
                buyer: {
                    2: {
                        'address': true
                    },
                    3 : {
                        'annual_salary': true,
                        'current_rent_amount': true,
                        'total_deposit_savings': true
                    }
                },
                landlord: {
                    2 : {
                        'agency_name': true,
                        'agency_address': true
                    }
                },
                seller: {
                    2 : {
                        'agency_name': true,
                        'agency_address:': true
                    }
                },
            }
        }
    },
    ...mapActions('auth', ['register']),
    methods: {
        setUserType(userType)
        {
            this.form.userType = userType;
            this.formStep = 1;
        },
        clearUserType()
        {
            this.form.userType = ''
        },
        setRegistrationStep(stepNumber)
        {
            this.formStep = stepNumber;
        },
        checkIfFieldStatus(fieldName)
        {
            let searchIn = this.requiredFields;
            let searchFor = [this.form.userType, this.formStep, fieldName]
            let i = 0;

            while(typeof searchIn !== 'undefined')
            {
                searchIn = searchIn[searchFor[i]];
                i++;

                if(searchFor.length === i)
                {
                    break;
                }
            }

            return searchIn;
        },
        checkIfLastStep()
        {
            if(this.requiredFields[this.form.userType] && typeof this.requiredFields[this.form.userType][this.formStep+1] === 'undefined')
            {
                return true;
            }
            else
            {
                return false;
            }
        },
        async submit () {
            await this.register(this.form)

            await this.$router.replace({name: 'login'})
        }
    }
}
</script>






