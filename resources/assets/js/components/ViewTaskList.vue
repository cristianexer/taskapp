<template>
    <div class="row">
        <div class="col-12">
            <div class="row">
            <div class="col-1 mx-auto">
                <router-link class="iconParent" v-bind:to="'/'">
                 <font-awesome-icon icon="arrow-left" />
                </router-link>
                <router-link class="iconParent my-2" v-bind:to="{name:'EditTaskList', params: { id: taskList.id}}">
                 <font-awesome-icon icon="cog" />
                </router-link>
            </div>
            <div class="col-11 mx-auto">
            <h1>{{ taskList.title }}</h1>
            <h2>{{ taskList.description }}</h2>
            </div>
            </div>
            <hr>
        </div>
        <div class="col-12">
            <div class="col-12 mx-auto" v-if="!getTasks">
                <h3 class="text-center my-3">You don't have any tasks, nice for you btw.</h3>
                <hr>
            </div>
            <div v-else v-for="task in tasks" class="col-12 my-3 taskWrapper">
                <router-link class="tasklink" :to="{name:'ViewTask', params: { id: task.id}}" >
                <div class="col-12 taskBody">
                    <div class="col-4 my-2">
                        <h2>
                        {{ task.title }}
                        </h2>
                    </div>
                    <div class="col-8">
                        <p>
                        {{ task.content }}
                        </p>
                    </div>
                    <div class="col-12 my-2">
                        <span class="badge badge-pill py-1 px-2 my-1" :class="task.status === options[task.status].value ? options[task.status].class : ''"><font-awesome-icon icon="clipboard-list" /> : {{ task.status === options[task.status].value ? options[task.status].text : '' }}</span>
                        <span class="badge badge-pill badge-dark py-1 px-2 my-1 mx-1"><font-awesome-icon icon="calendar-alt" /> : {{ task.deadline }}</span>
                    </div>
                </div>
                </router-link>
            </div>
            <div class="col-12 my-3 createTask">
                <div class="col-12 py-4 text-center">
                    <div v-if="!createComp" @click="toggleComponent" class="col-12">Create task <font-awesome-icon icon="plus-circle" /></div>
                    <div v-if="createComp" class="col-12 createTaskContainer">
                        <CreateTask></CreateTask>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                taskList: {
                    title:'',
                    description:''
                },
                tasks:{
                    title:'',
                    content:'',
                    status:'',
                    deadline:'',
                    files:'10',
                },
                createComp : false,
                options: {
                  todo: { text: 'To do', value: 'todo', class:'badge-danger' },
                  justStarted: { text: 'Just started', value: 'justStarted', class:'badge-info' },
                  onWorking:{ text: 'On working', value: 'onWorking', class:'badge-warning' },
                  done:{ text: 'Done', value: 'done', class:'badge-success' },
                }

            };
        },
        created: function () {
            if (window.Laravel.user) {
                let uri = `http://localhost:8000/taskslist/${this.$route.params.id}`;
                Axios.get(uri).then((response) => {
                    this.taskList = response.data.taskList[0],
                    this.tasks = response.data.tasks
                });
            }
        },
        methods:{
            toggleComponent: function(){
                if(!this.createComp){
                    this.createComp = true;
                }
                else{
                    this.createComp = false;
                }
            },
            reloadTasks: function(){
                if (window.Laravel.user) {
                let uri = `http://localhost:8000/taskslist/${this.$route.params.id}`;
                Axios.get(uri).then((response) => {
                    this.tasks = response.data.tasks
                    });
                }
            }
        },
        computed: {
            getTasks: function () {
                return (this.tasks.length > 0) ? this.tasks : false;
            },
            getAuthUser: function () {
                return window.Laravel.user;
            }
        }
    }

</script>

