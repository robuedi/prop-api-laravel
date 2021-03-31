<template>
    <div>
        <button v-for="(btnName, btnId) in btns" type="button" :class="{ 'active' : activeSection === btnId}" @click="setActiveSection(btnId)" class="mb-5 mr-4 btn btn-outline-dark">
            {{btnName}}
        </button>

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

import AddProperty from "../components/AddProperty";
import { mapGetters } from 'vuex'
import PropertyListingAccount from "../components/PropertyListingAccount";

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
        }

    }
}
</script>
