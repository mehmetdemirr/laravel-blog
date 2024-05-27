<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix("/auth")->group(function () {
    Route::get("/login",[LoginController::class,"index"])->name("login");
    Route::post("/login",[LoginController::class,"login"]);
    Route::post("/logout",[LoginController::class,"logout"])->name("logout");

    Route::get("/register",[RegisterController::class,"index"])->name("register");
    Route::post("/register",[RegisterController::class,"register"]);
});

Route::prefix("/admin")->middleware(["auth"])->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');
    
    Route::get("/articles",[ArticleController::class,"index"])->name('article.index'); 
    Route::get("/articles/create",[ArticleController::class,"create"])->name('article.create');  
    
    
    Route::get("/categories",[CategoryController::class,"index"])->name('category.index'); 
    Route::get("/categories/create",[CategoryController::class,"create"])->name('category.create'); 
    Route::post("/categories/create",[CategoryController::class,"store"])->name('category.store'); 
    Route::post("/categories/change-status",[CategoryController::class,"changeStatus"])->name('category.changeStatus');  
    Route::post("/categories/change-feature-status",[CategoryController::class,"changeFeatureStatus"])->name('category.changeFeatureStatus');
    Route::post("/categories/delete",[CategoryController::class,"delete"])->name('category.delete');
    Route::get("/categories/{id}/edit",[CategoryController::class,"edit"])->name('category.edit')->whereNumber('id');
    Route::post("/categories/{id}",[CategoryController::class,"update"])->name('category.update')->whereNumber('id');
    
});

Route::get('/', function () {
    return view('admin.index');
})->name('home');
