<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return Post::query()->paginate(10);
    }

    public function show(Post $post)
    {
        return $post;
    }
}
