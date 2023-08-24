<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Session;
use File;

class ActionController extends Controller
{
    public function post(){
        return view('post');
    }
    public function feed(){
        $posts = Post::orderBy('created_at', 'desc')->where('status',1)->paginate(15);
        return view('feed',compact('posts'));
    }
    public function likePost(Request $req){
        $post_id = $req->id;
        $user_id = Session::get('id');
        // Check Liked or not
        $liked = false;
        $checkLike = Like::where('post_id', $post_id)->where('user_id', $user_id)->first();
        if($checkLike){
            $liked = true;
        }
        if(!$liked){
            $like = new Like();
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->save();

            $post = Post::find($post_id);
            $post->likes = $post->likes+1;
            $post->save();
        }
        else{
                $checkLike->delete();
    
                $post = Post::find($post_id);
                $post->likes = $post->likes-1;
                $post->save();
        }
        echo "Done";
    }
    public function getLikes(Request $req){
        $post = Post::find($req->id);
        echo $post->likes;
    }
    public function getComments(Request $req){
        $post = Post::find($req->id);
        echo $post->comments;
    }
    public function getRecentComments(Request $req){
        $comments = Comment::where('post_id', $req->id)->orderBy('created_at', 'desc')->get();
        
        return response()->json($comments);
    }

    public function addComment(Request $req){
        $comment = new Comment;
        $comment->post_id = $req->id;
        $comment->user_id = Session::get('id');
        $comment->user_name = Session::get('username');
        $comment->comment = $req->comment;
        $comment->save();

        $post = Post::find($req->id);
        $post->comments = $post->comments+1;
        $post->save();
        echo "Done";
    }


    public function savePost(Request $req){
        $post = new Post;
        $post->post = $req->post;
        $post->created_by = Session::get('id');
    
        // Check Code
        $unique_code = rand(1111,999999999999);
        $post->unique_code = $unique_code;
        $arr = []; // Initialize $arr variable
        
        if ($req->hasFile('file')){
            $files = $req->file('file');
            foreach ($files as $file){
                $filename = time().'-'.$file->getClientOriginalName();
                $location = 'assets/posts';
                $file->move($location,$filename);
                $arr[] = $filename;
            }
            $post_file = implode(",", $arr);
        }
        else{
            $post_file = '';
        }
        $post->files = $post_file; // Use correct variable name here
        $post->save();
        session()->flash('success','Your post has been added successfully');
        return redirect()->back();
    }
    
}