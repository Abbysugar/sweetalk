<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /*
     *method for creating posts
     */
    public function createPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:1000',
        ]);
        $post       = new Post;
        $post->body = $request['body'];

        $message = 'An error occured, try again!';
        if ($request->user()->posts()->save($post)) {
            $message = 'Successfully created post!!!';
        }

        return redirect()->to('home')->with(['message' => $message]);
    }

    /*
     *method for displaying posts
     */
    public function getPost()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('home', ['posts' => $posts]);
    }

    public function deletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();

        if (Auth::user() != $post->user) {
            return redirect()->back();
        }

        $post->delete();

        return redirect()->to('home')->with(['message' => 'Successfully deleted post!']);
    }

    /*
     *method for editing posts
     *by post owner only
     */
    public function editPost($post_id)
    {

        $post = Post::where('id', $post_id)->first();

        // if (Auth::user() != $post->user) {
        //     return redirect()->back();
        // }
        return view('layouts.edit', ['post' => $post]);
    }

    /*
     *method for updating the
     *edited posts
     */
    public function updatePost(Request $request, $post_id)
    {
        $this->validate(request(), [

            'body' => 'required',
        ]);

        Post::updateOrCreate(
            ['id' => $post_id],
            [
                'body' => $request->body,
            ]
        );

        $post       = new Post;
        $post->body = $request['body'];

        //    if ($request->user()->posts()->save($post)){
        //     $message = 'Successfully updated post!!!';
        // }
        return redirect()->to('home')->with(['message' => 'Successfully updated post!!!']);
    }

    /*
     *method for displaying user 
     *profile
     */
    public function getProfile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    /*
     *method for editing and saving
     *user profile
     */
    public function saveProfile(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);

        $user       = Auth::user();
        $user->name = $request['name'];

        if ($request->file('image') != null) {

            $file     = $request->file('image');
            $filename = $request['name'] . '-' . $user->id . '.jpg';

            Storage::disk('uploads')->put($filename, File::get($file));

            $user->image = $filename;
        }

        $user->save();

        return redirect()->to('profile');
    }

    /*
     *method for uploading a
     *user's profile image
     */
    public function userImage($filename)
    {
        $file = Storage::disk('local')->get($filename);

        return new Response($file, 200);
    }

    /*
     *method for liking posts
     */
    public function like($id)
    {
        $like = Like::where('user_id', Auth::user()->id)->where('post_id', $id)->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create(['user_id' => Auth::user()->id, 'post_id' => $id]);
        }

        return redirect()->back();
    }

    /*
     *method for commenting on 
     *posts
     */
    public function comment(Request $request, $id)
    {
        $comment = Comment::where('user_id', Auth::user()->id)->where('post_id', $id)->first();

        $this->validate(request(), [

            'comment' => 'required',
        ]);

        Comment::create(['user_id' => Auth::user()->id, 'post_id' => $id, 'body' => $request->comment]);

        return redirect()->to('home')->with(['message' => 'Successfully posted comment!']);
    }

    /*
     *method for displaying all 
     *user comments
     */
    public function getComment()
    {
        $comments = App\Comment::with('user_id')->get();

        foreach ($comments as $comment) {
            echo $book->user_id->name;
        }

    }
}
