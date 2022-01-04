<template>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Publicar una cancion</div>
        <div>
            <div class="card-body">
                <div v-if="saveOk == false">
                    <form action="">
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label text-md-end">Titulo</label>
                                        
                            <div class="col col-md-6">
                                <input class="form-control" id="title" type="text" v-model="title">

                                <div class="alert alert-danger" role="alert" v-if="titleErrors.length > 0">
                                    <strong>{{this.titleErrors[0]}}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file" class="col-md-3 col-form-label text-md-end">Cancion</label>
                                        
                            <div class="col col-md-6">
                                <input class="form-control" id="file" type="file" ref="file" name="file" accept="audio/*" v-on:change="handleFileUpload">
                                            
                                <div class="alert alert-danger" role="alert" v-if="fileErrors.length > 0">
                                    <strong>{{this.fileErrors[0]}}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" v-on:click="sendSong">Subir</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="alert alert-success" v-else>
                    <strong>Se ha guardado correctamente</strong>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                saveOk: false,
                title: "", // Title debe estar definido con comillas vacias porque si lo definis como NULL, php no te hace las validaciones
                file: "", // File debe estar definido con comillas vacias porque si lo definis como NULL, php no te hace las validaciones
                titleErrors: [],
                fileErrors: [] 
            }
        },
        mounted(){
            this.$emit('load');
        },
        methods:{
            sendSong(){
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('title', this.title);              
               
               //Limpio los errores que podrian llegar a contener
                this.titleErrors = [];
                this.fileErrors = [];

                axios.post('/song',formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    this.saveOk = true;
                }).catch(error => {
                    this.file = ""; //Borro el archivo guardado para que vuelva a ingresar otro
                    this.$refs.file.value = null;

                    if(error.response.data.errors.title){
                        this.titleErrors = error.response.data.errors.title;
                    }
                    if(error.response.data.errors.file){
                        this.fileErrors = error.response.data.errors.file;
                    }
                });
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        }
    }
</script>
