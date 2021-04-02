<template>
    <div>
        <template v-for="(btnName, btnId) in btns" v-if="checkIfAvailable(btnId)">
            <button type="button" :class="{ 'active' : activeSection === btnId}" @click="setActiveSection(btnId)" class="mb-5 mr-4 btn btn-outline-dark">
                {{btnName}}
            </button>
        </template>

        <template v-if="activeSection === 'properties'">
            <PropertyListingAccount />
        </template>

        <template v-if="activeSection === 'addProperty'">
            <AddProperty/>
        </template>

        <template v-if="activeSection === 'profile'">
            <p>{{user.name}}</p>
            <p>{{user.email}}</p>
        </template>
    </div>
</template>

<script>

import AddProperty from "../components/partials/AddProperty";
import { mapGetters } from 'vuex'
import PropertyListingAccount from "../components/partials/PropertyListingAccount";

export default {
    components: {
        PropertyListingAccount,
        AddProperty
    },
    data () {
        return {
            activeSection: 'properties',
            btns: {
                'properties': 'My Properties',
                'addProperty': '+Add property',
                'profile': 'Profile'
            }

        }
    },
    computed: {
        ...mapGetters('auth', ['user'])
    },
    methods: {
        setActiveSection(sectionName)
        {
            this.activeSection = sectionName
        },
        checkIfAvailable(btnId)
        {
            if(btnId === 'addProperty' && ![3,4].includes(this.user.type_id))
            {
                return false;
            }

            return true;
        }
    }
}
</script>
