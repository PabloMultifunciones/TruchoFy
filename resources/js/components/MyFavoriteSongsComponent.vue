<template>
<div>
    <song-component 
        v-for="song in songs" 
        :key="song.id"
        :song="song"
        :editable="false"
        :favoritable="false"
        :dropeable="true">
    </song-component>
    <div class="alert alert-warning" role="alert" v-show="noSongs">
        <strong>Todavia no tiene ninguna cancion en esta lista</strong>
    </div>
</div>
</template>

<script>
    import SongComponent from './SongComponent.vue'
    export default {
        data(){
            return{
                songs: null,
                noSongs: false
            }
        },
        mounted(){
            axios.get('/myfavoritesongs')
            .then(response => {
                this.songs = response.data;
                this.$emit('load');
                if(this.songs.length == 0){
                    this.noSongs = true;
                }
            });
        }
    }
</script>
