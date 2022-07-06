<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::when(request('search'),function($query){
                            $query->where('name','like',"%".request('search')."%");
                        })
                        ->latest()
                        ->paginate(5)
                        ->withQueryString();
        
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return redirect('/categories/create')
            ->withErrors($validator)
            ->withInput();
        }
        
        $category = new Category();

        $category->name = $request->name;
        $category->created_at = now();
        $category->updated_at = now();
        $category->save();

        session()->flash('success', 'A Category was created succcessfully.');
        return redirect('/categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if($validator->fails()){
            return redirect('/categories/edit/{$id}')
            ->withErrors($validator)
            ->withInput();
        }
        
        $category = Category::findOrFail($id);
        
        $category->name = $request->name;
        $category->created_at = now();
        $category->updated_at = now();
        $category->save();

        session()->flash('success', 'A Category was edited succcessfully.');
        return redirect('/categories');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.show',compact('category'));
    }

    public function destroy($id)
    {
        // Category::destroy($id);

        $post = Category::findOrFail($id);
        $post->delete();

        return redirect('/categories');
    }
}
