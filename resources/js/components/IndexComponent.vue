<template>
<div>
    <song-component 
        v-for="(song, index) in songs" 
        :key="song.id"
        :song="song"
        :editable="false"
        :favoritable="true"
        :dropeable ="false"
        v-show=" (pag - 1) * NUM_RESULTS <= index && index < pag * NUM_RESULTS">
    </song-component>
    <div class="d-flex justify-content-center">
        <button class="btn btn-primary" v-show="pag != 1" v-on:click="pag = pag-1">Anterior</button>
        <button class="btn btn-primary" v-show="pag * NUM_RESULTS / songs.length < 1" v-on:click="pag = pag+1">Siguiente</button>
    </div>
</div>
</template>

<script>
    import SongComponent from './SongComponent.vue'
    export default {
        data(){
            return{
                pag: 1,
                NUM_RESULTS: 3,
                songs: null
            }
        },
        mounted(){
            axios.get('/song')
            .then(response => {
                this.songs = response.data;
                this.$emit('load');
            });
        }
    }
</script>
