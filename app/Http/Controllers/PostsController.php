<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->input('size')?$request->input('size'):10;
        $order = $request->input('order')?$request->input('order'):'desc';
        $cloumn = $request->input('cloumn')?$request->input('cloumn'):'id';
        if ($order=='ascending') {
            $order = 'asc';
        } else {
            $order = 'desc';
        }
        $post = Post::query()
            ->select(['users.name','posts.title', 'posts.created_at', 'posts.id'])
            ->leftJoin('users', 'users.id', '=', 'posts.user_id');
        if ($request->input('name')) {
            $post = $post->where('users.name', $request->input('name'));
        }
        if ($request->input('date_begin')) {
            $post = $post->where('posts.created_at', '>=',$request->input('date_begin'));
        }
        if ($request->input('date_end')) {
            $post = $post->where('posts.created_at', '<=',$request->input('date_end'));
        }
        $post = $post->orderBy($cloumn,$order)->paginate($size);
        return $post;
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
                'msg' => '发布失败，服务器出错'
            ]);
        }
        return response()->json([
            'success' => true,
            'msg' => '发布成功'
        ]);
    }
}
