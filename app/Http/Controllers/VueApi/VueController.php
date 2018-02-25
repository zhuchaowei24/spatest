<?php

namespace App\Http\Controllers\VueApi;

use App\Models\Rendering;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class VueController extends Controller
{
    public function rendering(Request $request)
    {
        $rendering = Rendering::query()->get()->toArray();
        return response()->json($rendering);
    }

    public function todo($id)
    {
        $todo_info  = Rendering::query()->find($id);
        return response()->json($todo_info);
    }

    public function todo_insert(Request $request)
    {
        $insert_arr = ['title' => $request->input('title'), 'compolte' => 1];
        $todo = Rendering::create($insert_arr);
        return $todo;
    }

    public function todo_delete($id)
    {
        $todo = Rendering::query()->where('id', $id);
        $todo = $todo->delete();
        return $todo;
    }

    public function todo_change($id)
    {
        $todo = Rendering::find($id);
        $todo->compolte = !$todo->compolte;
        $todo->save();
        return $todo;
    }
}
