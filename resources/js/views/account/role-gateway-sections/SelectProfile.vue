<template>
    <div>
        <div class="mb-5" v-if="userRolesList.length">
            <h1>Select an existing profile</h1>
            <button type="button" v-for="userRole in userRolesList" @click="userRole.is_completed === 1 ? setActiveUserRole(userRole) : completeUserRole(userRole.id)" class="btn btn-outline-dark btn-lg btn-block">
                {{ userRole.role.name }}
                <small v-if="userRole.is_completed === 0">(Needs completion)</small>
            </button>
        </div>
        <div v-if="newRoles.length">
            <h1>Create a new profile</h1>
            <button type="button" v-for="role in newRoles" @click="makeUserRole(role.id)" class="btn btn-outline-dark btn-lg btn-block">
                {{ role.name }}
            </button>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    props: {
        userRolesList: Array
    },
    data(){
        return {
            newRoles: []
        }
    },
    methods:{
        ...mapActions('roles', ['getRoles', 'setUserRole']),
        ...mapActions('roleUser', ['setUserRole']),
        ...mapActions('auth', ['me', 'setActiveRole']),
        setActiveUserRole(userRole)
        {
            this.setActiveRole(userRole)
            this.$router.push({name: 'accountProfile'})
        },
        completeUserRole(userRoleId)
        {
            this.$router.push({name: 'completeRole', params: { userRoleId: userRoleId }});
        },
        makeUserRole(roleId)
        {
            this.setUserRole(roleId).then((res) => {
                this.me().then(()=>{
                    this.$router.push({name: 'completeRole', params: { userRoleId: res.id }});
                })
            })
        }
    },
    mounted() {
        this.getRoles().then((res) => {
            let userRolesIds = this.userRolesList.map(userRole => userRole.role.id);
            this.newRoles = res.data.data.filter(role => !userRolesIds.includes(role.id))
        });
    }
}
</script>

<style scoped>

</style>
