<template id="createTask">
<div class="row">
    <div class="col-12">
        <form class="my-2 text-left" v-on:submit.prevent = "createTask">
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
            <select class="form-control" v-model="task.status">
                <option v-for="option in options" v-bind:value="option.value" >
                        {{ option.text }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="taskDeadline">Task Deadline</label>
            <input id="taskDeadline" required v-model="task.deadline" type='date' class="form-control" />
        </div>
    <button type="submit" class="btn btn-dark">Create</button>
    <div class="btn btn-danger" @click="this.$parent.toggleComponent">Cancel</div>
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
                    status:'todo',
                    deadline: new Date().toJSON().slice(0,10),
                    tasks_list_id: this.$route.params.id
                },
                options: [
                  { text: 'To do', value: 'todo' },
                  { text: 'Just started', value: 'justStarted' },
                  { text: 'On working', value: 'onWorking' },
                  { text: 'Done', value: 'done' },
                ]

             }
    },
    methods:{
        createTask : function(){
            let uri = 'http://localhost:8000/tasks/';
            Axios.post(uri, this.task).then((response)=>{
                this.$parent.toggleComponent();
                this.$parent.reloadTasks();
            }).catch(err=>console.log(err));
        }
    }
}
</script>