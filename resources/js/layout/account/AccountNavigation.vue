<template>
    <div>
        <template v-for="(btnInfo, btnId) in btns" v-if="btnInfo.roles.includes(activeRole.role_id)">
            <button type="button" @click="$router.push({name: btnId})" :class="{ 'active' : activeSection === btnId}"  class="mb-5 mr-4 btn btn-outline-dark">
                {{btnInfo.name}}
            </button>
        </template>
    </div>
</template>


<script>

import apiStates from "../../extra/account/rolesSections";
import { mapGetters } from 'vuex'

export default {
    props: {
        activeSection: String
    },
    data () {
        return {
            btns: null
        }
    },
    computed: {
        ...mapGetters('auth', [
            'user',
            'activeRole'
        ]),
    },
    mounted() {
        this.btns = apiStates
    },
    methods: {
        setActiveSection(sectionName)
        {
            this.activeSection = sectionName
        },
    }
}
</script>

<style scoped>

</style>
