<template id="createTaskList">
<div class="row">
    <div class="col-12">
        <form class="my-3 text-left" v-on:submit.prevent = "createTaskList">
        <div class="form-group">
            <label for="taskListTitle">Task list title</label>
            <input type="text" class="form-control" v-model="taskList.title" required id="taskListTitle" placeholder="Task list title"/>
        </div>
        <div class="form-group">
            <label for="taskListDescription">Task list description</label>
            <textarea class="form-control" rows="4" cols="50" v-model="taskList.description" required id="taskListDescription" placeholder="Task list description"></textarea>
        </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <div class="btn btn-warning" @click="this.$parent.toggleComponent">Cancel</div>
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
    methods:{
        createTaskList : function(){
            let uri = 'http://localhost:8000/taskslist';
            Axios.post(uri, this.taskList).then((response)=>{
                this.$router.push({name:'ViewTaskLists'})
            }).catch(err=>console.log(err));
            this.$parent.toggleComponent();
            this.$parent.reloadTaskLists();
        }
    }
}
</script>
