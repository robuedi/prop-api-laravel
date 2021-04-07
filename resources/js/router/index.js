import VueRouter from 'vue-router'
window.Vue.use(VueRouter)
import routes from './routes';

export default new VueRouter({
    mode: 'history',
    base: '/',
    routes,
});
