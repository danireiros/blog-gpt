<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Http\Requests\Comment\Store;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        try {
            $validated = $request->validated();

            $request->validate([
                'post_id' => 'required',
            ]);

            $comment = new Comment();
            $comment->text = strip_tags($validated['text']);
            $comment->user_id = auth()->id();
            $comment->post_id = $validated['post_id'];

            if(isset($validated['parent_comment_id'])) {
                $parentComment = Comment::findOrFail($validated['parent_comment_id']);
                $comment->parent_comment_id = $parentComment->id;
            }

            $comment->save();

            return redirect()->back()->with('message', 'Comentario enviado con éxito.');
        } catch (\Exception $e) {
            //dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Like a comment.
     */
    public function like(Comment $comment)
    {
        if (!$comment->likes()->where('user_id', auth()->id())->exists()) {
            $comment->increment('likes');
            $like = new CommentLike();
            $like->comment_id = $comment->id;
            $like->user_id = auth()->id();
            $like->save();
        }else{
            $comment->decrement('likes');
            $comment->likes()->where('user_id', auth()->id())->delete();
        }

        return response()->json(['likes' => $comment->likes]);
    }
}
