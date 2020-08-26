<template>
    <v-row dense>
        <v-col cols="12">
            <v-card>
                <v-card-title class="headline">{{tarea.created_at}} - {{tarea.updated_at}}</v-card-title>

                <v-textarea rows="1"  v-if="editMode" v-model="tarea.description"></v-textarea>
                <v-card-subtitle v-else>{{tarea.description}}</v-card-subtitle>

                <v-card-actions>
                    <v-btn text v-if="editMode" v-on:click="onClickUpdate()">Guardar cambios</v-btn>
                    <v-btn text v-else v-on:click="onClickEdit()">Editar</v-btn>
                    <!-- <v-spacer></v-spacer> -->
                    <v-btn color='red' text v-on:click="onClickDelete()">Eliminar</v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
  export default {
        props: ['tarea'],
        data() {
            return {
                editMode:false
            };
        },
        methods:{
            onClickDelete(){
                axios.delete(`tareas/${this.tarea.id}`).then(() => {
                    
                    this.$emit('delete');
                });
                // this.$emit('delete');
            },
            onClickEdit(){
                this.editMode = true;
            },
            onClickUpdate(){
                const params = {
                    description: this.tarea.description
                }
                axios.put(`tareas/${this.tarea.id}`,params).then((response) => {
                    this.editMode = false;
                    const tarea = response.data;
                    this.tarea.updated_at = tarea.updated_at;
                    this.$emit('update', tarea);
                });
                // this.editMode = false;
                // this.$emit('update', this.tarea);
            },
        }
  }
</script>