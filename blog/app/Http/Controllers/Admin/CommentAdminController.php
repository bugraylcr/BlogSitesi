<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentAdminController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();

        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->approved = true;
        $comment->save();

        return back()->with('status', 'Yorum onaylandı.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('status', 'Yorum silindi.');
    }
}


