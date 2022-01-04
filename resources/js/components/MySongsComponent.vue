<template>
<div>
    <div v-if="exist">
        <song-component 
            v-for="song in songs" 
            :key="song.id"
            :song="song"
            :editable="true"
            :favoritable="false"
            :dropeable="false">
        </song-component>
    </div>
    <div class="alert alert-warning" role="alert" v-else>
        <strong>No tienes ninguna cancion subida todavia</strong>
    </div> 
</div>
</template>

<script>
    import SongComponent from './SongComponent.vue'
    export default {
        data(){
            return{
                songs: null,
                exist: true
            }
        },
        mounted(){
            axios.get('/mysongs')
            .then(response => {
                this.$emit('load');
                if(response.data.length > 0){
                    this.songs = response.data;
                }else{
                    this.exist = false;   
                }
            });
        }
    }
</script>
