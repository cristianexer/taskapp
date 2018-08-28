<template id="viewTask">
    <div class="row">
        <div class="col-12">
                <div class="row">
                    <div class="col-1 mx-auto">
                        <router-link class="iconParent" v-bind:to="{name:'ViewTaskList', params: { id: task.tasks_list_id}}" >
                            <font-awesome-icon icon="arrow-left" />
                        </router-link>
                        <router-link class="iconParent my-2" v-bind:to="{name:'EditTask', params: { id: task.id}}">
                            <font-awesome-icon icon="cog" />
                        </router-link>
                    </div>
                    <div class="col-11 mx-auto">
                        <h1>{{task.title}}</h1>
                        <h2>{{task.content}}</h2>
                    </div>
                    <div class="col-6 mx-auto">
                        <div class="row">
                            <div class="col-3  mx-auto text-center px-2  badge-pill badge-dark "><font-awesome-icon icon="clipboard-list" /> : {{task.status}}</div>
                            <div class="col-3 mx-auto  text-center px-2  badge-pill badge-dark"><font-awesome-icon icon="calendar-alt" /> : {{task.deadline}}</div>
                        </div>
                    </div>
                </div>
            <hr>
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
                deadline: '',
                tasks_list_id: '',
            }

        }
    },
    created: function () {
        if (window.Laravel.user) {
            let uri = `http://localhost:8000/tasks/${this.$route.params.id}`;
            Axios.get(uri).then((response) => {
                this.task = response.data[0]
                }).catch(err=>console.log(err));
            }
        },
    methods:{
    }
}
</script>