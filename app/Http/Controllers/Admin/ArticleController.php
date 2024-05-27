<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'admin',
            // new Middleware('log', only: ['index']),
            // new Middleware('subscribed', except: ['store']),
        ];
    }

    public function index(){
        return view("admin.articles.index");
    }

    public function create(){
        return view("admin.articles.create");
    }
}
