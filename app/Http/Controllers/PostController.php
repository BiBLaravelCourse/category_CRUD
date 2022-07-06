<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // $posts = Post::all();

        // $posts = Post::paginate(2);


        // $posts = Post::where('title','like','%'.$request->search.'%')->paginate(5);

        // $posts = DB::table('posts')
        //         ->join('users', 'posts.user_id', '=', 'users.id')
        //         ->select('posts.*', 'users.name',)
        //         ->paginate(3);

        // $posts = Post::select('posts.*', 'users.name',)
        //         ->join('users', 'posts.user_id', '=', 'users.id')
        //         ->orderBy('id','desc')
        //         ->paginate(3);

        // $posts = DB::table('category_post')
        //         ->join('posts', 'category_post.post_id', '=' , 'posts.id')
        //         ->join('categories', 'category_post.category_id', '=' , 'categories.id')
        //         ->select('posts.*','categories.name as category')
        //         ->paginate(5);

        $posts = Post::when(request('search'), function($query){
            $query->where('title','like','%'.request('search').'%');
            })
            ->select('posts.*', 'categories.name as category',)
            ->join('category_post', 'posts.id', '=', 'category_post.post_id')
            ->join('categories', 'category_post.category_id', '=', 'categories.id')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/posts/create')
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post();

        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->id();
        $post->created_at = now();
        $post->updated_at = now();
        $post->save();

        // Post::create([
        //     'title' => $request->title,
        //     'body' => $request->body,            
        //     'user_id' => auth()->id(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        $categories = $request->categories;
        foreach( $categories as $category){
            DB::table('category_post')->insert([
                'post_id' => $post->id,
                'category_id' => $category,
                ]);
        }    

        session()->flash('success', 'A post was created succcessfully.');

        // $request->session()->flash('success','A post was created succcessfully.');

        return redirect('/posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        $post_categories =  DB::table('category_post')
                ->where('post_id', $id)
                ->get();

        return view('posts.edit', compact('post','categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
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

        $post->update($request->only(['title', 'body']));

        $post->save();

        //Old Category Data Delete
        DB::table('category_post')->where('post_id', $post->id)->delete();
        
        //Insert New Category
        $categories = $request->categories;
        foreach( $categories as $category){
            DB::table('category_post')->insert([
                'post_id' => $post->id,
                'category_id' => $category,
                ]);
        }    
        // session()->flash('success','Post was edited succcessfully.');

        return redirect('/posts')->with('success', 'Post was edited succcessfully.');
    }

    public function show($id)
    {
        $post = Post::find($id);

        // $post = DB::table('posts')
        //         ->where('posts.id', '=', $id)
        //         ->join('users', 'posts.user_id', '=', 'users.id')
        //         ->select('posts.*', 'users.name',)
        //         ->first();

        // $post = Post::where('posts.id', '=', $id)   //find($id)
        //     ->join('users', 'posts.user_id', '=', 'users.id')
        //     ->select('posts.*', 'users.name as author')
        //     ->first();

        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        // posts::destroy($id);

        $post = Post::find($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post was deleted succcessfully.');
    }
}
