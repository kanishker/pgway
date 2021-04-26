<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\like;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like(Request $request)
    {
        $like = like::where('post_id',$request->post_id)
        ->where('user_id',Auth::user()->id)->get();
        if(count($like)>0){
            $like->deleteAll();
            return response()->json([
                'sucess'=>true,
                'messge'=>'unliked'
            ]);

        }
        $like  = new like;
        $like->user_id = Auth::user()->id;
        $like->post_id = $request->id;
        $like->save();

        return response()->json([
            'sucess'=>true,
            'messge'=>'liked'
        ]);
    }
}
