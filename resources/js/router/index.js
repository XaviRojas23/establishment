import Vue from 'vue';
import VueRouter from 'vue-router';
import VuePageTransition from 'vue-page-transition';
import BeginningEstablishment from '../components/BeginningEstablishment'
import ShowEstablishment from '../components/ShowEstablishment'


const routes = [{
        path: '/',
        component: BeginningEstablishment
    },
    {
        path: '/establishment/:id',
        name: "establishment",
        component: ShowEstablishment
    }

]

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);
Vue.use(VuePageTransition);


export default router;