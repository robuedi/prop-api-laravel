<template>
    <div>
        <div class="mb-5" v-if="userRolesList.length">
            <h1>Select profile</h1>
            <button type="button" v-for="userRole in userRolesList" @click="userRole.is_completed === 1 ? setActiveUserRole(userRole) : completeUserRole(userRole)" class="btn btn-outline-dark btn-lg btn-block">
                {{ userRole.role.name }}
                <small v-if="userRole.is_completed === 0">(Needs completion)</small>
            </button>
        </div>
        <div v-if="newRoles.length">
            <h1>Add profile</h1>
            <button type="button" v-for="role in newRoles" @click="makeUserRole(role.id)" class="btn btn-outline-dark btn-lg btn-block">
                {{ role.name }}
            </button>
        </div>
    </div>
</template>

<script>

import {mapActions, mapGetters} from "vuex";
import apiStates from "../store/apiStates/apiStateValues";
import Role from "../api/models/Role";
import RoleUser from "../api/models/RoleUser";

export default {
    watch: {
        authApiStateLoaded() {
            this.initLoad()
        }
    },
    computed: {
        ...mapGetters('auth', {
            user: 'user',
            authApiState: 'authApiState'
        }),
        authApiStateLoaded() {
            return this.authApiState === apiStates.LOADED;
        },
        authApiStateLoading() {
            return this.authApiState === apiStates.INIT || this.apiState === apiStates.LOADING;
        }
    },
    data(){
        return {
            newRoles: [],
            userRolesList: []
        }
    },
    methods:{
        ...mapActions('auth', ['me', 'setActiveRole']),
        setActiveUserRole(userRole)
        {
            this.setActiveRole(userRole)
            this.$router.push({name: 'accountProfile'})
        },
        completeUserRole(userRole)
        {
            this.setActiveRole(userRole)
            this.$router.push({name: 'completeRole', params: { userRoleId: userRole.id }});
        },
        makeUserRole(roleId)
        {
            RoleUser.store(roleId).then((res) => {
                //set the new role as the active one
                this.setActiveRole(res.data.data)

                //refetch the user
                this.me().then(()=>{
                    this.$router.push({name: 'completeRole', params: { userRoleId: res.data.data.id }});
                })
            })
        },
        initLoad() {
            if(this.authApiStateLoaded) {
                this.userRolesList = this.user.user_role

                //get any other roles
                Role.all().then((res) => {
                    let userRolesIds = this.userRolesList.map(userRole => userRole.role.id);
                    this.newRoles = res.data.data.filter(role => !userRolesIds.includes(role.id))
                });
            }
        }
    },
    mounted() {
        this.initLoad()
    }
}
</script>
