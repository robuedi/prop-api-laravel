<template>
    <div>
        <template >
            <AgencyInfo :roleUserId="this.roleUserId | parseInt" v-if="activeStep === 0" v-on:hasAgencyInfo="hasAgencyInfo"/>
            <AgencyAddress :agencyId="this.data.agencyId | parseInt" v-if="activeStep === 1" v-on:hasAgencyAddress="addressCompleted()"/>
        </template>
    </div>
</template>

<script>
import AgencyAddress from '../profile-sections/AgencyAddress'
import AgencyInfo from '../profile-sections/AgencyInfo'

export default {
    components: {
        AgencyInfo,
        AgencyAddress
    },
    props: {
        roleUserId: Number
    },
    data () {
        return {
            activeStep: 0,
            errors: [],
            data:{
                agencyId: null
            }
        }
    },
    methods: {
        hasAgencyInfo(agencyInfo)
        {
            this.data.agencyId = agencyInfo.data.data.id
            this.activeStep = 1;
        },
        addressCompleted()
        {
            this.$emit('checkIfProfileCompleted');
        },
    }
}
</script>





