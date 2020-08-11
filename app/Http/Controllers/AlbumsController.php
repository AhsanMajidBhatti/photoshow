<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Album;

class AlbumsController extends Controller
{
    public function index(){
        $albums = Album::with('Photo')->get();
        return view('albums.index')->with('albums', $albums);
    }

    public function create(){
        return view('albums.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1999'
        ]);

        // Get filename with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        // Uplaod image
        $path= $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);

        $album = new Album;

        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $filenameToStore;

        $album->save();

        return redirect('/')->with('success', 'Album Created');
    }

    public function show($id){
        $album = Album::with('Photo')->find($id);
        return view('albums.show')->with('album', $album);
    }

    public function destroy($id){
        $album = Album::find($id);

        if(Storage::delete('public/album_covers/'.$album->cover_image)){
            $album->delete();

            return redirect('/')->with('success', 'Album Deleted');
        }
    }
}
