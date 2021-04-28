import Home from "../views/Home";
import Property from "../views/Property";
import SignIn from "../views/SignIn";
import store from "../store";
import Register from "../views/Register";
import Roles from "../views/Roles";
import CompleteRole from "../views/CompleteRole";
import Account from "../views/account/Account";
import Profile from "../views/account/Profile";
import MyProperties from "../views/account/MyProperties";
import Applications from "../views/account/Applications";
import AddProperty from "../views/account/AddProperty";

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
        path: '/roles',
        name: 'chooseRoles',
        component: Roles
    },
    {
        path: '/complete-role/:userRoleId',
        name: 'completeRole',
        component: CompleteRole
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
