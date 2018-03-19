<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return Post::query()->orderBy('id','desc')->paginate(10);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function push(Request $request)
    {
        $user = $request->user();
        $post = new Article();
        $post->title = $request->input('title');
        $post->body = $request->input('content');
        $post->user_id = $user['id'];
        $post->created_at = Carbon::now()->toDateTimeString();
        if (!$post->save()) {
            return response()->json([
                'success' => false,
                'msg' => '发布失败服务器出错'
            ]);
        }
        return response()->json([
            'success' => true,
            'msg' => '发布成功'
        ]);
    }
}
