import Home from "../views/home/Home";
import Property from "../views/Property";
import SignIn from "../views/SignIn";
import store from "../store";
import Register from "../views/Register";
import RolesGateway from "../views/account-roles/RolesGateway";
import CompleteRoleGateway from "../views/account-roles/CompleteRoleGateway";
import Account from "../views/account/Account";
import Profile from "../views/account/sections/Profile";
import MyProperties from "../views/account/sections/MyProperties";
import Applications from "../views/account/sections/Applications";
import AddProperty from "../views/account/sections/AddProperty";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/property/:propertySlug',
        name: 'propertyItem',
        component: Property
    },
    {
        path: '/signin',
        name: 'signIn',
        component: SignIn,
        beforeEnter(to, from, next) {
            if (store.getters["auth/authenticated"]) {
                next({
                    name: "account"
                });
            }
            else {
                next()
            }
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/choose-roles',
        name: 'chooseRoles',
        component: RolesGateway
    },
    {
        path: '/complete-role/:userRoleId',
        name: 'completeRole',
        component: CompleteRoleGateway
    },
    {
        path: '/account',
        name: 'account',
        component: Account,
        children:[
            {
                path: '',
                name: 'accountProfile',
                component: Profile,
            },
            {
                path: 'my-properties',
                name: 'userProperties',
                component: MyProperties
            },
            {
                path: 'applications',
                name: 'userApplications',
                component: Applications
            },
            {
                path: 'add-property',
                name: 'addProperty',
                component: AddProperty
            }
        ]
    },
];

export default routes;
