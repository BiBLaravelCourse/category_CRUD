<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::paginate(3);
    }

 
    public function store(CategoryStoreRequest $request)
    {
        return Category::create(['name' => $request->name]);
    }

  
    public function show($id)
    {
        return Category::find($id);
    }


    public function update(CategoryUpdateRequest $request, $id)
    {
        return Category::find($id)->update(['name' => $request->name]);
    }

    public function destroy($id)
    {
        return Category::find($id)->delete();
    }
}
