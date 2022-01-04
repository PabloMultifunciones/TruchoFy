<template>
<div v-if="droped == false">
    <div class="col-md-12 mb-3" v-if="deleted == false">
        <div class="card">
            <div class="card-header d-flex">
                <strong>Cancion: {{song.title}}</strong>
                <strong v-show="dropeable == false && editable == false" class="ms-auto">Publicado Por: {{song.user}}</strong>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <audio controls>
                        <source :src="song.file" type="audio/mp3">
                    </audio>
                    <button class="btn btn-danger mt-4" v-if="dropeable" v-on:click="dropFavoriteSong">Quitar de Favoritos</button>
                    <button class="btn btn-success mt-4" v-if="favoritable && isFavorite == false" v-on:click="addSong">Agregar A Favoritos</button>
                    <button class="btn btn-danger mt-4" v-if="editable" v-on:click="sendDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success" role="alert" v-else>
        <strong>Se ha eliminado correctamente</strong>
    </div>
</div>
</template>

<script>
    export default {
        props:{
            song: Object,
            editable: Boolean,
            favoritable: Boolean,
            dropeable: Boolean
        },
        data(){
            return{
                deleted: false,
                isFavorite: false,
                droped: false
            }
        },
        mounted(){
            axios.get(`/isfavoritesong/${this.song.id}`)
            .then(response => {
                if(response.data == true){
                    this.isFavorite = true
                }
            })
        },
        methods: {
            sendDelete(){
                axios.delete(`/deletesong/${this.song.id}`)
                .then(() => {
                    this.deleted = true;
                });
            },
            addSong(){
                axios.post('/myfavoritesongs',{song_id : this.song.id});
                this.isFavorite = true;
            },
            dropFavoriteSong(){
                axios.get(`/dropfavoritesong/${this.song.id}`)
                .then(() => {
                    this.droped = true;
                });
                
            }
        }
    }
</script>
