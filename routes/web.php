<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

//User
Route::get('/register',[RegisterController::class,'create'] );
Route::post('/register',[RegisterController::class,'store'] );

Route::get('/login',[LoginController::class,'create'] );
Route::post('/login',[LoginController::class,'store'] );
Route::delete('/logout',[LoginController::class,'destroy'] );


//Page
Route::view('/','index');


//Posts
Route::get('/posts',[PostController::class,'index']);

Route::get('/posts/create',[PostController::class,'create'])->middleware('myauth');
Route::post('/posts/store',[PostController::class,'store']);

Route::get('/posts/edit/{id}',[PostController::class,'edit'] );
Route::post('/posts/update/{id}',[PostController::class,'update'] );

Route::get('/posts/show/{id}',[PostController::class,'show'] );
Route::delete('/posts/delete/{id}',[PostController::class,'destroy'] );


//Categories
Route::get('/categories',[CategoryController::class,'index']);

Route::get('/categories/create',[CategoryController::class,'create'])->middleware('myauth');
Route::post('/categories/store',[CategoryController::class,'store']);

Route::get('/categories/edit/{id}',[CategoryController::class,'edit'] );
Route::post('/categories/update/{id}',[CategoryController::class,'update'] );

Route::get('/categories/show/{id}',[CategoryController::class,'show'] );
Route::delete('/categories/delete/{id}',[CategoryController::class,'destroy'] );


