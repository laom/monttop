<template>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form-tarea-component
                @new="addTarea"
            ></form-tarea-component>     
            <tarea-component 
                v-for="(tarea,index) in sortedItems" 
                :key="tarea.id"
                :tarea="tarea" 
                @delete="deleteTarea(index)"
                @update="updateTarea(index, ...arguments)"
            >
            </tarea-component>     

        </div>

           
    </div>
  
</template>

<script>
  export default {
    data() {
        return {
            // tareas: [
            //     {
            //         'id' : 1,
            //         'description' : 'Lorem ipsum',
            //         'created_at' : '20/08/20'
            //     }
            // ]
            tareas : []
        }
    },
    mounted(){
        axios.get('tareas').then((response) => {
            this.tareas = response.data;
            // this.tareas.sortedItems;
        });
    },
    methods:{
        addTarea(tarea){
            this.tareas.push(tarea);
        },
        deleteTarea(index){
            this.tareas.splice(index,1)
        },
        updateTarea(index, tarea){
            this.tareas[index] = tarea;
        }
        
    },
    computed: {
        sortedItems: function() {
            this.tareas.sort( ( a, b) => {
                return new Date(b.created_at) - new Date(a.created_at);
            });
            return this.tareas;
        }
    }
  }
</script>