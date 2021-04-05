<template>
    <div>
        <h1>Create a profile</h1>
        <button type="button" v-for="roles in rolesList" @click="makeUserRole(roles.id)" class="btn btn-outline-dark btn-lg btn-block">
            {{ roles }}
        </button>
    </div>
</template>

<script>

export default {
name: "CreateProfile"
}
</script>

<style scoped>

</style>
