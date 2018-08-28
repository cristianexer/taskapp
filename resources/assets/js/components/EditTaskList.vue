<template id="editTaskList">
<div class="row">
    <div class="col-12">
        <form class="my-3 text-left" v-on:submit.prevent = "updateTaskList">
        <div class="form-group">
            <label for="editTaskListTitle">Task list title</label>
            <input type="text" class="form-control" v-model="taskList.title" required id="editTaskListTitle" placeholder="Task list title"/>
        </div>
        <div class="form-group">
            <label for="editTaskListDescription">Task list description</label>
            <textarea class="form-control" rows="4" cols="50" v-model="taskList.description" required id="editTaskListDescription" placeholder="Task list description"></textarea>
        </div>
    <button type="submit" class="col-2 mx-1 my-1 btn btn-primary">Save</button>
    <div class="col-2 mx-1 my-1 btn btn-warning" @click="$router.go(-1)">Cancel</div>
    <div class="col-2 mx-1 my-1 btn btn-danger" @click="deleteTaskList">Delete</div>

        </form>
    </div>
</div>
</template>

<script>
export default {
    data: function(){
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        return {taskList: {title:'', description: ''} }
    },
    created: function () {
        if (window.Laravel.user) {
            let uri = `http://localhost:8000/taskslist/${this.$route.params.id}/edit`;
            Axios.get(uri).then((response) => {
                this.taskList = response.data
                }).catch(err=>console.log(err));
            }
        },
    methods:{
        updateTaskList : function(){
            let uri = `http://localhost:8000/taskslist/${this.$route.params.id}`;
            Axios.patch(uri, this.taskList).then((response)=>{
                this.$router.push({name:'ViewTaskLists'})
            }).catch(err=>console.log(err));

        },
        deleteTaskList : function(){
            let uri = `http://localhost:8000/taskslist/${this.$route.params.id}`;
            Axios.delete(uri, this.taskList).then((response)=>{
                this.$router.push({name:'ViewTaskLists'})
            }).catch(err=>console.log(err));

        }
    }
}
</script>
