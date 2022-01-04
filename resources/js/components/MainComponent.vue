<template>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-8">
                  <div class="row">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" id="btnMenu" class="col col-3 btn btn-primary" v-on:click="changeOption('index')">Inicio</button>
                            <button type="button" id="btnMenu" class="col col-3 btn btn-primary" v-on:click="changeOption('publish')">Publicar</button>
                            <button type="button" id="btnMenu" class="col col-3 btn btn-primary" v-on:click="changeOption('mysongs')">Mis Canciones</button>
                            <button type="button" id="btnMenu" class="col col-3 btn btn-primary" v-on:click="changeOption('myfavoritesongs')">Mis Favoritas</button>
                        </div>
                    </div>
                <div class="card">
                    
                
                    
                    <div>
                        <div class="card-body">
                            <form-component @load="isLoad" v-if="option=='publish'"></form-component>
                            <index-component @load="isLoad" v-if="option=='index'"></index-component>
                            <mysongs-component @load="isLoad" v-if="option=='mysongs'"></mysongs-component>
                            <myfavoritesongs-component @load="isLoad" v-if="option=='myfavoritesongs'"></myfavoritesongs-component>
                            <div v-if="load" class="alert alert-warning" role="alert">
                                <strong>Cargando...</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FormComponent from './FormComponent.vue'
    import IndexComponent from './IndexComponent.vue'
    import MySongsComponent from './IndexComponent.vue'
    export default {
        data(){
            return{
                option: "index",
                load: true
            }
        },
        methods: {
            changeOption(option){
                this.load = true;
                this.option = option;
            },
            isLoad(){
                this.load = false;
            }
        }
    }
</script>
