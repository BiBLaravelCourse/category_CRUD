<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostImage;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::where('title','like','%'.$request->search.'%')->orderby('id','desc')->paginate();

        return view('posts.index', compact('posts'));
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

        // $posts = Post::when(request('search'), function($query){
        //     $query->where('title','like','%'.request('search').'%');
        //     })
        //     ->select('posts.*', 'categories.name as category',)
        //     ->join('category_post', 'posts.id', '=', 'category_post.post_id')
        //     ->join('categories', 'category_post.category_id', '=', 'categories.id')
        //     ->orderBy('id', 'desc')
        //     ->paginate(5);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        // Create New Post
        $post = auth()->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        //Upload Multiple Image
        foreach($request->file('images') as $file){
            $filename = time().'_'.$file->getClientOriginalName();
            $dir = '/upload/images';

            $path = $file->storeAs($dir, $filename);

            PostImage::create([
                'post_id' => $post->id,
                'path' => $path,
            ]);
        }

        //Add Category
        $post->categories()->attach($request->categories);

        session()->flash('success', 'A post was created succcessfully.');
        return redirect(route('posts.index'));

        // $post = new Post();

        // $post->title = $request->title;
        // $post->body = $request->body;
        // $post->user_id = auth()->id();
        // $post->created_at = now();
        // $post->updated_at = now();
        // $post->save();

        // Post::create([
        //     'title' => $request->title,
        //     'body' => $request->body,            
        //     'user_id' => auth()->id(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // $categories = $request->categories;
        // foreach( $categories as $category){
        //     DB::table('category_post')->insert([
        //         'post_id' => $post->id,
        //         'category_id' => $category,
        //         ]);
        // }    
      

        // $request->session()->flash('success','A post was created succcessfully.');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $oldCategories = $post->categories->pluck('id')->toArray();

        return view('posts.edit', compact('post','categories','oldCategories'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        // Post Update
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        // Delete Old Image
        foreach( $post->images as $image){
            Storage::delete($image->path);
            PostImage::where('post_id', $post->id)->delete();
        }

        // Upload Multiple Image
        foreach($request->file('images') as $file){
            $filename = time().'_'.$file->getClientOriginalName();
            $dir = '/upload/images';

            $path = $file->storeAs($dir, $filename);

            PostImage::create([
                'post_id' => $post->id,
                'path' => $path,
            ]);
        }

        // Update Category
        $post->categories()->sync($request->categories);

        return redirect(route('posts.index'))->with('success', 'Post was edited succcessfully.');

        // $post->title = $request->title;
        // $post->body = $request->body;
        // $post->created_at = now();
        // $post->updated_at = now();

        // $post->update([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'updated_at' => now(),
        // ]);

        // $post->update($request->only(['title', 'body']));

        // $post->save();

        //Old Category Data Delete
        // DB::table('category_post')->where('post_id', $post->id)->delete();
        
        //Insert New Category
        // $categories = $request->categories;
        // foreach( $categories as $category){
        //     DB::table('category_post')->insert([
        //         'post_id' => $post->id,
        //         'category_id' => $category,
        //         ]);
        // }    
        // session()->flash('success','Post was edited succcessfully.');
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

        return back()->with('success', 'Your Post was deleted succcessfully.');
    }
}
