<template>
    <div>
        <template >
            <AnnualSalary v-if="activeStep === 0" v-on:hasAnnualSalary="annualSalaryCompleted()"/>
            <Savings v-if="activeStep === 1" v-on:hasSavings="savingsCompleted()"/>
            <Employment v-if="activeStep === 2" v-on:hasEmployment="employmentCompleted()"/>
            <UserAddress v-if="activeStep === 3" v-on:hasAddress="addressCompleted()"/>
        </template>
    </div>
</template>

<script>
import AnnualSalary from '../../../components/profile-sections/AnnualSalary'
import Savings from '../../../components/profile-sections/Savings'
import Employment from '../../../components/profile-sections/Employment'
import UserAddress from '../../../components/profile-sections/UserAddress'

export default {
    components: {
        UserAddress,
        AnnualSalary,
        Savings,
        Employment
    },
    data () {
        return {
            activeStep: 0,
            errors: []
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
        savingsCompleted()
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





