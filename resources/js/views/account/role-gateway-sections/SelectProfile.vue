<template>
    <div>
        <h1>Select a profile</h1>
        <button type="button" v-for="userRole in userRolesList" @click="userRole.is_completed === 1 ? setActiveUserRole(userRole) : completeUserRole(userRole.id)" class="btn btn-outline-dark btn-lg btn-block">
            {{ userRole.role.name }}
            <small v-if="userRole.is_completed === 0">(Needs completion)</small>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        userRolesList: Array
    },
    methods:{
        setActiveUserRole(userRole)
        {
            this.setActiveRole(userRole)
            this.$router.push({name: 'accountProfile'})
        },
        completeUserRole(userRoleId)
        {
            this.$router.push({name: 'completeRole', params: { userRoleId: userRoleId }});
        },
    }
}
</script>

<style scoped>

</style>
