<template id="tasklists">
    <div class="row">
        <div v-if="getAuthUser === null" class="col-12">
            <h4 class="text-center">Sorry budy, you are not logged in.</h4>
            <h5 class="text-center">Please log in to use me.</h5>
        </div>
        <div class="col-12" v-else>
            <div class="row">
                <div class="col-12 text-center" v-if="getTaskLists === false">
                    <h2>You don not have any task lists</h2>
                </div>

                <div v-else v-for="(tList, index) in getTaskLists" class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 taskListWrapper">
                    <div class="col-12 taskListBody">
                        <div class="col-12 my-2 taskListTitle">
                            <h4>{{ tList.title }}</h4>
                        </div>
                        <div class="col-12 my-2 taskListDescription">
                            <p class="text-justify">{{ tList.description }}</p>
                        </div>
                        <div class="row">
                        <div class="col-12 my-2 action text-center">
                            <router-link class="btn btn-full" v-bind:to="{name:'ViewTaskList', params: { id: tList.id}}">Show list <span class="badge badge-secondary">{{ tList.tasks }}</span></router-link>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 taskListCreate my-2 text-center">
                    <div class="col-12 linkBody">
                        <div class="createTaskLink" v-if="!createComp" @click="toggleComponent">Create list <font-awesome-icon icon="plus-circle" /></div>
                        <div v-if="createComp" class="col-12 addTaskListContainer">
                            <CreateTaskList v-bind:class="{ 'active': createComp }"></CreateTaskList>
                        </div>
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
                taskLists: '',
                createComp: false,
            };
        },
        created: function () {
            if (window.Laravel.user) {
                let uri = 'http://localhost:8000/taskslist';
                Axios.get(uri).then((response) => {
                    this.taskLists = response.data;
                });
            }
        },
        methods:{
            toggleComponent: function(){
                this.createComp === false ? this.createComp = true : this.createComp = false;
            }
            ,
            reloadTaskLists:function(){
                if (window.Laravel.user) {
                let uri = 'http://localhost:8000/taskslist';
                Axios.get(uri).then((response) => {
                    this.taskLists = response.data;
                });
            }
            },

        },
        computed: {
            getTaskLists: function () {
                return (this.taskLists.length > 0 ) ? this.taskLists : false;
            },
            getAuthUser: function () {
                return window.Laravel.user;
            }
        }
    }

</script>
