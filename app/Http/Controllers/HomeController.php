<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Song;

use App\Models\User;

use App\Models\Song_User;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\SongRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function saveSong(SongRequest $request){
        $song = new Song;
        $song->title = $request->title;
        $song->user_id = auth()->user()->id;

        //PARA HACER ESTO TUBE QUE AGREGAR UN NUEVO 'DISK' en config/filesystems.php
        $filename = Str::random(20) . '.' . $request->file->getClientOriginalExtension();
        Storage::disk('music')->putFileAs('/songs',$request->file('file'),$filename);
        $songPath = url('songs/' . $filename);

        $song->file = $songPath;
        $song->save();
        return $songPath;
    }

    public function allSongs(){
        $songs = Song::all();
        foreach($songs as $song){
            $song->user= User::find($song->user_id)->name;
        }
        return $songs;
    }

    public function mySongs(){
        $songs = Song::where('user_id',auth()->user()->id)->get();
        return $songs;
    }

    public function deleteSong($song_id){
        $song = Song::find($song_id);

        $song_user= new Song_User;
        $results = $song_user->where('song_id',$song_id)->get()->all();
        foreach($results as $result){
            $result->delete();
        }

        $song->delete();
    }

    public function myFavoriteSongs(){
        $user = new User;
        $usuario = $user->find(auth()->user()->id);
        $songs = $usuario->songs()->get()->all();
        return $songs;
    }

    public function addFavoriteSongs(Request $request){
        $newFavorite = new Song_User;
        $newFavorite->user_id = auth()->user()->id;
        $newFavorite->song_id = $request->song_id;
        $newFavorite->save();
    }

    public function isFavoriteSong($song_id){
        $user_id = auth()->user()->id;
        $song_user = new Song_User;
        $result = $song_user->where('user_id',$user_id)->where('song_id',$song_id)->get()->all();
        
        if(sizeof($result) > 0){
            return true;
        }
        return false;
    }

    public function dropFavoriteSong($song_id){
        $user_id = auth()->user()->id;
        $song_user = new Song_User;
        $result = $song_user->where('user_id',$user_id)->where('song_id',$song_id)->get()->first();
        $result->delete();

    }
}
