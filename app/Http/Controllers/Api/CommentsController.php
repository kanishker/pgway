<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\comments;

class CommentsController extends Controller
{
    public function create(Request $request)
    {
            $comment = new comments;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->id;
            $comment->comment = $request->comment;
            $comment->save();

            return response()->json([
                'success'=>true,
                'message'=>'Commented'
    
            ]);
    }

    public function update(Request $request)
    {
        $comment=comments::find($request->id);

        if(Auth::user()->id != $comment->user_id)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized access'

            ]);
        }
        $comment->comment = $request->comment;
        $comment->update();
        return response()->json([
            'success'=>true,
            'message'=>'Comment edited'

        ]);
    }

    public function delete(Request $request)
    {
        $comment=comments::find($request->id);

        if(Auth::user()->id != $comment->user_id)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized access'

            ]);
        }
        $comment->comment = $request->comment;
        $comment->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Comment Deleted'

        ]);
    }

    public function comments(Request $request)
    {
        $comments = comments::where('post_id',$request->id)->get();
        foreach ($comments as $comment) {
            $comment->user;
        }
        return response()->json([
            'success'=>true,
            'message'=>$comments

        ]);
    }
    
}
