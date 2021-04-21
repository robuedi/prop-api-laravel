<template>
    <div>
        <AccountNavigation activeSection="userProperties"/>
        <div class="card-columns" v-if="userProperties.length > 0">
            <PropertyItemAccount v-for="property in userProperties" :key="property.id" :property="property"/>
        </div>
        <p v-if="loadingStatus">{{ loadingStatus }}</p>
    </div>
</template>

<script>
import AccountNavigation from "../layout/AccountNavigation";
import PropertyItemAccount from "../partials/PropertyItemAccount";
import {mapGetters} from "vuex";
import RoleUserProperty from "../../../api/models/RoleUserProperty";
import QueryBuilder from "../../../api/QueryBuilder";

export default {
    components: {
        PropertyItemAccount,
        AccountNavigation
    },
    data () {
        return {
            userProperties: [],
            loadingStatus: 'Loading data...'
        }
    },
    computed: {
        ...mapGetters('auth', {
            activeRole: 'activeRole',
        }),
    },
    mounted() {
        //make the query string
        const query = new QueryBuilder();
        query.setInclude(['address', 'address.city', 'address.city.country', 'images'])
        query.setFields('properties', ['id', 'name', 'slug', 'created_at'])
        query.setFields('address', ['id', 'property_id', 'city_id', 'postcode', 'address_line'])
        query.setFields('address.city', ['id', 'country_id', 'name'])
        query.setFields('address.city.country', ['id', 'name'])
        query.setFields('images', [ 'path'])

        RoleUserProperty.all(this.activeRole.id, query.get()).then((res) => {
            this.userProperties = res.data.data
            this.loadingStatus = this.userProperties.length === 0 ? 'No properties added.' : ''
        }).catch((error) => {
            this.loadingStatus = 'We encountered problems loading the data...'
            throw error
        })
    },
}
</script>
