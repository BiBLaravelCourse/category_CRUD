<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();

        $posts = Post::paginate(2);
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'body' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/posts/create')
            ->withErrors($validator)
            ->withInput();
        }
        
        // $post = new Post();

        // $post->title = $request->title;
        // $post->body = $request->body;
        // $post->created_at = now();
        // $post->updated_at = now();
        // $post->save();

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('success','A post was created succcessfully.');

        // $request->session()->flash('success','A post was created succcessfully.');

        return redirect('/posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit',compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'body' => 'required'
        ]);
        if($validator->fails()){
            return redirect('/posts/edit/{$id}')
            ->withErrors($validator)
            ->withInput();
        }
        
        $post = Post::find($id);
        
        // $post->title = $request->title;
        // $post->body = $request->body;
        // $post->created_at = now();
        // $post->updated_at = now();

        // $post->update([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'updated_at' => now(),
        // ]);
        
        $post->update($request->only(['title','body']));

        $post->save();
        
        // session()->flash('success','Post was edited succcessfully.');

        return redirect('/posts')->with('success','Post was edited succcessfully.');
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show',compact('post'));
    }

    public function destroy($id)
    {
        // posts::destroy($id);

        $post = Post::find($id);
        $post->delete();

        return redirect('/posts')->with('success','Post was deleted succcessfully.');
    }
}
