<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // validate data
        $validateData = $this->validatePostData();
        // image upload
        if (request()->hasFile('image')) {
            // get filename with extension
            $filenameWithExt = request()->file('image')->getClientOriginalName();
            // get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get extension
            $extension = request()->file('image')->getClientOriginalExtension();
            // file name to store ( create filename that we can store in db )
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            $path = request()->file('image')->storeAs('public/images/', $filenameToStore);
        } else {
            $filenameToStore = 'my_jpeg.jpeg';
        }

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->title = request('title');
        $post->image_url = $filenameToStore;
        $post->excerpt = request('excerpt');
        $post->body = request('body');

        $post->save();
        // Post::create($validateData);
        return redirect('/posts')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dd($post);
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'You can not edit this post.');
        }

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        if (request()->hasFile('image')) {
            $validateData = $this->validatePostData();
        } else {
            $validateData = request()->validate([
                'title' => 'required',
                'excerpt' => 'required',
                'body' => 'required'
            ]);
        }

        // image upload
        $filenameToStore = $this->uploadImage();

        $post->title = request('title');
        if (request()->hasFile('image')) {
            $post->image_url = $filenameToStore;
        }
        $post->excerpt = request('excerpt');
        $post->body = request('body');

        $post->save();
        return redirect('/posts/' . $post->id)->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = new Post();

        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'You can not delete this post.');
        }

        $post->where('id', $id)->delete();
        return redirect('/posts')->with('success', 'Post deleted successfully.');
    }

    // Validation
    public function validatePostData()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'required | max:1999'
        ]);
    }

    // my posts
    public function myposts()
    {
        return view('posts.index', [
            'posts' => auth()->user()->posts
        ]);
    }

    // upload image
    public function uploadImage()
    {
        if (request()->hasFile('image')) {
            // get filename with extension
            $filenameWithExt = request()->file('image')->getClientOriginalName();
            // get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get extension
            $extension = request()->file('image')->getClientOriginalExtension();
            // file name to store ( create filename that we can store in db )
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            $path = request()->file('image')->storeAs('public/images/', $filenameToStore);
        } else {
            $filenameToStore = 'my_jpeg.jpeg';
        }
        return $filenameToStore;
    }
}
