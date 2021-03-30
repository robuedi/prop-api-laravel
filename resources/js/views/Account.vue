<template>
    <div>
        <button v-for="(btnName, btnId) in btns" type="button" :class="{ 'active' : activeSection === btnId}" @click="setActiveSection(btnId)" class="mb-5 mr-4 btn btn-outline-dark">
            {{btnName}}
        </button>

        <template v-if="activeSection === 'properties'">
            <p>Sale - Rent - Bought - Renting</p>
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

export default {
    components: {
        AddProperty
    },
    data () {
        return {
            activeSection: 'properties',
            btns: {
                'properties': 'Properties',
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
