require('./bootstrap');

window.Vue = require('vue');

window.VueRouter = require('vue-router').default;

window.VueAxios = require('vue-axios').default;

window.Axios = require('axios').default;

import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(fas,fab);

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false;


let appLayout = require('./components/App.vue');

//show task lists
const taskLists = Vue.component('ViewTaskLists', require('./components/ViewTaskLists.vue'));

//show task list
const taskList = Vue.component('ViewTaskList', require('./components/ViewTaskList.vue'));

//create task list
const createTaskList = Vue.component('CreateTaskList', require('./components/CreateTaskList.vue'));

//edit task lists
const editTaskList = Vue.component('EditTaskList', require('./components/EditTaskList.vue'));

//create task 
const createTask = Vue.component('CreateTask', require('./components/CreateTask.vue'));

//view task 
const viewTask = Vue.component('ViewTask', require('./components/ViewTask.vue'));

//edit task 
const editTask = Vue.component('EditTask', require('./components/EditTask.vue'));

Vue.use(VueRouter, VueAxios, axios);

const routes = [
    {
        name: 'ViewTaskLists',
        path: '/',
        component: taskLists
    },
    {
        name: 'ViewTaskList',
        path: '/taskList/:id',
        component: taskList
    },
    {
        name: 'CreateTaskList',
        path: '/createTaskList',
        component: createTaskList
    },
    {
        name: 'EditTaskList',
        path: '/editTaskList/:id',
        component: editTaskList
    },
    {
        name: 'CreateTask',
        path: '/createTask',
        component: createTask
    },
    {
        name: 'ViewTask',
        path: '/viewTask/:id',
        component: viewTask
    },
    {
        name: 'EditTask',
        path: '/editTask/:id',
        component: editTask
    },


];
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

new Vue(
    Vue.util.extend({
            router
        },
        appLayout
    )

).$mount('#app');
