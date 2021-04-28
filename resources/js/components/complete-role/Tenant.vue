<template>
    <div>
        <template >
            <AnnualSalary :roleUserId="this.roleUserId | parseInt" v-if="activeStep === 0" v-on:hasAnnualSalary="annualSalaryCompleted()"/>
            <Rent :roleUserId="this.roleUserId | parseInt" v-if="activeStep === 1" v-on:hasRent="rentCompleted()"/>
            <Employment :roleUserId="this.roleUserId | parseInt" v-if="activeStep === 2" v-on:hasEmployment="employmentCompleted()"/>
            <RoleUserAddress :roleUserId="this.roleUserId | parseInt" v-if="activeStep === 3" v-on:hasAddress="addressCompleted()"/>
        </template>
    </div>
</template>

<script>
import AnnualSalary from '../profile-sections/AnnualSalary'
import Rent from '../profile-sections/Rent'
import Employment from '../profile-sections/Employment'
import RoleUserAddress from '../profile-sections/RoleUserAddress'

export default {
    components: {
        RoleUserAddress,
        AnnualSalary,
        Rent,
        Employment
    },
    props: {
        roleUserId: Number
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





