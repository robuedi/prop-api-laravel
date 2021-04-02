<template>
    <div>
        <template v-for="(btnName, btnId) in btnsAll" >
            <button type="button" @click="$router.push({name: btnId})" :class="{ 'active' : activeSection === btnId}"  class="mb-5 mr-4 btn btn-outline-dark">
                {{btnName}}
            </button>
        </template>
    </div>
</template>


<script>

import { mapGetters } from 'vuex'

export default {
    props: {
        activeSection: String
    },
    data () {
        return {
            btns: {
                'accountProfile': 'Profile',
                'userApplications': 'Applications',
            },
            owners: {
                'userProperties': 'My Properties',
                'addProperty': 'Add property',
            }
        }
    },
    computed: {
        ...mapGetters('auth', ['user']),
        btnsAll (){
            if(this.user && this.user.type_id)
            {
                return {...this.btns, ...this.owners}
            }

            return this.btns
        }
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
