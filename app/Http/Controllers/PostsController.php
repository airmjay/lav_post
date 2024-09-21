<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = DB::select("SELECT * FROM posts");
        return view('posts.index')->with('post', $post);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        if($request->hasFile('cover_image'))
        {
            // get full filename and extension
            $filenameWithExtension = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            // get file extension
            $filenameExtension = $request->file('cover_image')->getClientOriginalExtension();
            // save file with name and time
            $fileTostore = $filename. "_".time().".".$filenameExtension;
            $path = $request->file('cover_image')->storeAs('/public/storage', $fileTostore); 
        }else
        {
            $fileTostore = "noimage.jpg";
        }
        $post = new post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->image = $fileTostore;
        $post->save();
        return redirect('/posts')->with('success','New Post have just been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = post::find($id);
        $unique = $post->user_id;
        if(auth()->user()->id != $unique){
           
        return redirect('/posts')->with('error', 'Unauthorized Page');
        
        }
        
        $post = post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, 
        [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        if($request->hasFile('cover_image'))
        {
            // get full filename and extension
            $filenameWithExtension = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            // get file extension
            $filenameExtension = $request->file('cover_image')->getClientOriginalExtension();
            // save file with name and time
            $fileTostore = $filename. "_".time().".".$filenameExtension;
            $path = $request->file('cover_image')->storeAs('public/cover_image', $fileTostore); 
        }
        $post = post::find($id);
        $unlink = $post->image;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image'))
        {
        if($unlink !== 'noimage.jpg'){
        Storage::delete('public/cover_image/'.$unlink);  
        } 
        $post->image = $fileTostore;
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post Have being Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = post::find($id);
        $unique = $post->user_id;
        if(auth()->user()->id != $unique){
           
        return redirect('/posts')->with('error', 'Unauthorized Page');
        
        }
        if($post->image != 'noimage.jpg')
        {
            Storage::delete('public/cover_image/'.$post->image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Have being Successfully Deleted');
    }
}
