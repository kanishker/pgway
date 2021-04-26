<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Post;


class postController extends Controller
{
    public function create(Request $request)
    {

        //dd(auth()->user());
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->desc = $request->desc;
        if($request ->photo !='')
        {
            $photo = time().'jpg';
            file_put_contents('storage/posts/'.$photo,base64_decode($request->photo));
            $post->photo = $photo;
        }

        $post->save();
        $post->user;
        
        return response()->json([
            'success'=>true,
            'message'=>'posted',
            'post'=>$post

        ]);


    }
    public function update(Request $request)
    {
        $post=Post::find($request->id);

        if(Auth::user()->id != $request->id)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized access'

            ]);
        }
        $post->desc = $request->desc;
        $post->update();
        return response()->json([
            'success'=>true,
            'message'=>'Post edited'

        ]);
    }
    public function delete(Request $request)
    {
        $post=Post::find($request->id);

        if(Auth::user()->id != $request->id)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized access'

            ]);
        }
        if($post->photo != '')
        {
            Storage::delete('public/posts/'.$post->photo);
        }
        $post->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Post deleted'

        ]);
    }
   public function posts()
    {
        $posts = Post::orderby('id','desc')->get();
        foreach ($posts as $post) {
            $post->user;
            $post['commentsCount']=count($post->comments);

            $post['likesCount']=count($post->likes);

            $post['selflike']=false;
           // dd($post->like);

        //    foreach($post->like as $likes)
        //     {
        //         if($likes->user_id == Auth::user()->id)
        //         {
        //             $post['selflike']=true;
        //         }
        //     }

        }
        return response()->json([
            'success'=>true,
            'message'=>$posts

        ]);
    }
}
