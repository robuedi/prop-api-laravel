<template>
    <div>
        <template >
            <AgencyInfo v-if="activeStep === 0" v-on:hasAgencyInfo="hasAgencyInfo()"/>
            <AgencyAddress v-if="activeStep === 1" v-on:hasAgencyAddress="addressCompleted()"/>
        </template>
    </div>
</template>

<script>
import AgencyAddress from '../../../components/profile-sections/AgencyAddress'
import AgencyInfo from '../../../components/profile-sections/AgencyInfo'

export default {
    components: {
        AgencyInfo,
        AgencyAddress
    },
    data () {
        return {
            activeStep: 0,
            errors: []
        }
    },
    methods: {
        hasAgencyInfo()
        {
            this.activeStep = 1;
        },
        addressCompleted()
        {
            this.$emit('checkIfProfileCompleted');
        },
    }
}
</script>
