<template id="editTask">
<div class="row">
    <div class="col-12">
        <form class="my-2 text-left" v-on:submit.prevent = "updateTask">
        <div class="form-group">
            <label for="taskTitle">Task title</label>
            <input type="text" class="form-control" v-model="task.title" required id="taskTitle" placeholder="Task title"/>
        </div>
        <div class="form-group">
            <label for="taskDescription">Task description</label>
            <textarea class="form-control" rows="4" cols="50" v-model="task.content" required id="taskDescription" placeholder="Task description"></textarea>
        </div>
        <div class="form-group">
            <label for="taskStatus">Task Status</label>
            <select class="form-control" v-model="task.status" >
                <option v-for="option in options" v-bind:value="option.value">
                        {{ option.text }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="taskDeadline">Task Deadline</label>
            <input id="taskDeadline" required v-model="task.deadline" type='date' class="form-control" />
        </div>
    <button type="submit" class="col-2 mx-1 my-1 btn btn-primary">Save</button>
    <div class="col-2 mx-1 my-1 btn btn-warning" @click="$router.go(-1)">Cancel</div>
    <div class="col-2 mx-1 my-1 btn btn-danger" @click="deleteTask">Delete</div>
        </form>
    </div>


</div>
</template>


<script>
export default {
    data: function(){
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        return {

            task:{
                title:'',
                content:'',
                status:'',
                deadline:'',
                tasks_list_id:''
                },
                options: [
                  { text: 'To do', value: 'todo' },
                  { text: 'Just started', value: 'justStarted' },
                  { text: 'On working', value: 'onWorking' },
                  { text: 'Done', value: 'done' },
                ]
            }
    },
    created: function () {
        if (window.Laravel.user) {
            let uri = `http://localhost:8000/tasks/${this.$route.params.id}/edit`;
            Axios.get(uri).then((response) => {
                this.task = response.data
                }).catch(err=>console.log(err));
            }
        },
    methods:{
        updateTask : function(){
            let uri = `http://localhost:8000/tasks/${this.$route.params.id}`;
            Axios.patch(uri, this.task).then((response)=>{
                this.$router.push({name:'ViewTaskList', params:{id : this.task.tasks_list_id}})
            }).catch(err=>console.log(err));

        },
        deleteTask : function(){
            let uri = `http://localhost:8000/tasks/${this.$route.params.id}`;
            let taskListId = this.task.tasks_list_id;
            Axios.delete(uri, this.task).then((response)=>{
                this.$router.push({name:'ViewTaskList', params:{id : taskListId}})
            }).catch(err=>console.log(err));

        }
    }
}
</script>
