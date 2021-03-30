<template>
    <div>
        <h1 class="mb-4">Register</h1>

        <!-- Step 0 -->
        <template v-if="!form.type_id">
            <button type="button" v-for="userType in userTypes" @click="setUserType(userType.id)" class="btn btn-outline-dark btn-lg btn-block">
                {{ userType.label }}
            </button>
        </template>
        <template v-else>
            <button type="button" class="btn btn-sm btn-outline-dark mb-4" @click="undoSteps()">Back</button>
        </template>

        <template v-if="form.type_id">
            <form action="#" @submit.prevent="submit">

                <div class="alert alert-warning alert-dismissible fade show" role="alert" v-for="error in errors">
                    {{ error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Step 1 -->
                <div class="mb-3" v-if="checkIfFieldStatus('name')">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" v-model="form.name" class="form-control w-50" id="name" >
                </div>

                <div class="mb-3" v-if="checkIfFieldStatus('email')">
                    <label for="InputEmail" class="form-label">Email address</label>
                    <input type="email" v-model="form.email" class="form-control w-50" id="InputEmail" >
                </div>

                <div class="mb-3" v-if="checkIfFieldStatus('dob')">
                    <label for="dob" class="form-label">Date of birth</label>
                    <input type="date" v-model="form.dob" class="form-control w-50" id="dob" >
                </div>

                <div class="mb-3" v-if="checkIfFieldStatus('password')">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control w-50" v-model="form.password" id="InputPassword">
                </div>

                <div class="mb-3" v-if="checkIfFieldStatus('password_confirmation')">
                    <label for="InputPassword2" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control w-50" v-model="form.password_confirmation" id="InputPassword2">
                </div>

                <!--  Step 2 or 3-->
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

                <AddressInputs title="Agency address" v-on:agencyAddressChange="agencyAddressChange" change-event="agencyAddressChange" v-if="checkIfFieldStatus('agency_address')"/>
                <AddressInputs title="Address" v-on:addressChange="addressChange" change-event="addressChange"  v-if="checkIfFieldStatus('address')"/>

                <button v-if="!checkIfLastStep()" type="button" @click="moveToNextStep()" class="btn btn-outline-dark">Next</button>
                <button v-else class="btn btn-success">Submit</button>

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
            userTypes: [],
            errors: [],
            form: {
                name: '',
                email: '',
                type_id: '',
                password: '',
                password_confirmation: '',
                dob: '',
                annual_salary: '',
                current_rent_amount: '',
                total_deposit_savings: '',
                agency_name: '',
                agency_address: {},
                address: {}
            },
            requiredFields: {
                1: {
                    1 :{
                        'name': true,
                        'email': true,
                        'dob': true,
                        'password': true,
                        'password_confirmation': true
                    },
                    2: {
                        'address': true
                    },
                    3 : {
                        'annual_salary': true,
                        'current_rent_amount':true
                    }
                },
                2: {
                    1 :{
                        'name': true,
                        'email': true,
                        'dob': true,
                        'password': true,
                        'password_confirmation': true
                    },
                    2: {
                        'address': true
                    },
                    3 : {
                        'annual_salary': true,
                        'current_rent_amount': true,
                        'total_deposit_savings': true
                    }
                },
                3: {
                    1 :{
                        'name': true,
                        'email': true,
                        'dob': true,
                        'password': true,
                        'password_confirmation': true
                    },
                    2 : {
                        'agency_name': true,
                        'agency_address': true
                    }
                },
                4: {
                    1 :{
                        'name': true,
                        'email': true,
                        'dob': true,
                        'password': true,
                        'password_confirmation': true
                    },
                    2 : {
                        'agency_name': true,
                        'agency_address': true
                    }
                },
            }
        }
    },
    methods: {
        ...mapActions('auth', ['register']),
        setUserType(userType)
        {
            this.form.type_id = userType;
            this.formStep = 1;
        },
        undoSteps()
        {
            if(this.formStep > 0)
            {
                this.formStep--;
            }
            else
            {
                this.form.type_id = ''
            }
        },
        setRegistrationStep(stepNumber)
        {
            this.formStep = stepNumber;
        },
        moveToNextStep()
        {
            //check if we have any required fields uncompleted
            this.checkFieldsCompleted();

            if(this.errors.length === 0)
            {
                this.formStep++
            }
        },
        checkFieldsCompleted()
        {
            //get current step fields
            let fields = this.requiredFields[this.form.type_id][this.formStep];

            this.errors = [];
            //check if fields left unchecked
            for (let [key, value] of Object.entries(fields)) {
                if(value === true && ((typeof this.form[key] === 'object' && _.isEmpty(this.form[key])) || this.form[key] === '')){
                    this.errors.push(`${key.replace(/_/g, " ")} field is required`);
                }
            }
        },
        checkIfFieldStatus(fieldName)
        {
            let searchIn = this.requiredFields;
            let searchFor = [this.form.type_id, this.formStep, fieldName]
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
            if(this.requiredFields[this.form.type_id] && typeof this.requiredFields[this.form.type_id][this.formStep+1] === 'undefined')
            {
                return true;
            }
            else
            {
                return false;
            }
        },
        addressChange(address)
        {
            this.form.address = address;
        },
        agencyAddressChange(address)
        {
            this.form.agency_address = address;
        },
        async submit () {
            //check if we have any required fields uncompleted
            this.checkFieldsCompleted();

            if(this.errors.length === 0)
            {
                await this.register(this.form)

                await this.$router.replace({name: 'signin'})
            }
        },
        fetchUserTypes()
        {
            axios.get(`/api/v1/user-types?&fields=id,label`).then((res) => {
                this.userTypes = res.data.data;
            }).catch((error) => {
                console.log(error)
            })
        }
    },
    mounted() {
        this.fetchUserTypes();
    }
}
</script>





