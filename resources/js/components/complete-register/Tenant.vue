<template>
    <div>
        <template >
            <AnnualSalary v-if="activeStep === 0" v-on:hasAnnualSalary="annualSalaryCompleted()"/>
            <Rent v-if="activeStep === 1" v-on:hasRent="rentCompleted()"/>
            <Employment v-if="activeStep === 2" v-on:hasEmployment="employmentCompleted()"/>
            <UserAddress v-if="activeStep === 3" v-on:hasAddress="addressCompleted()"/>
        </template>
    </div>
</template>

<script>
import AnnualSalary from '../profile-sections/AnnualSalary'
import Rent from '../profile-sections/Rent'
import Employment from '../profile-sections/Employment'
import UserAddress from '../profile-sections/UserAddress'

export default {
    components: {
        UserAddress,
        AnnualSalary,
        Rent,
        Employment
    },
    data () {
        return {
            activeStep: 0,
            errors: [],
        }
    },
    methods: {
        addressChange(address)
        {
            this.form.address = address;
        },
        annualSalaryCompleted()
        {
            this.activeStep = 1;
        },
        rentCompleted()
        {
            this.activeStep = 2;
        },
        employmentCompleted()
        {
            this.activeStep = 3;
        },
        addressCompleted()
        {
            this.$emit('checkIfProfileCompleted');
        },
    }
}
</script>





