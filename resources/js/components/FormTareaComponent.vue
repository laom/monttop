<template>
    <v-row dense>
        <v-col cols="12">
            <v-card  >
                <v-form
                                ref="form"
                                v-model="form"
                                v-on:submit.prevent="newTarea()"
                            >
                <v-container>
                    <v-row >
                        <v-col >
                            

                                <v-textarea
                                :rules="[rules.required, rules.length(6)]"
                                auto-grow
                                label="Tarea"
                                rows="1"
                                v-model="description"
                                ></v-textarea>

                            
                            <!-- <v-divider></v-divider> -->
                            
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-btn text @click="$refs.form.reset()">Limpiar</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn :disabled="!form" type='submit' >Guardar</v-btn>
                </v-card-actions>
                </v-form>
            </v-card>
        </v-col>
    </v-row>
  
</template>

<script>
  export default {
    data: () => ({
        description: '',
        form: false,
        
        rules: {
            length: len => v => (v || '').length >= len || `Invalid character length, required ${len}`,
            required: v => !!v || 'This field is required',
        },
    }),
    methods:{
        newTarea(){
            const params = {
                description: this.description
            }
            axios.post('tareas',params).then((response) => {
                const tarea = response.data;
                this.$emit('new',tarea);
                this.description = "";
            });
            // let tarea = {
            //     id:2,
            //     description: this.description,
            //     created_at: '20/08/20'
            // };
            // this.$emit('new',tarea);
            // this.description = "";
        }
    }
  }
</script>