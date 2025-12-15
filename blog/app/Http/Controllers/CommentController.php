<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Story;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'story_id' => $story->id,
            'parent_id' => $data['parent_id'] ?? null,
            'name' => $data['name'],
            'email' => $data['email'],
            'body' => $data['comment'],
            'approved' => false,
        ]);

        return redirect()->back()->with('status', 'Yorumunuz alındı, onaylandıktan sonra yayınlanacaktır.');
    }
}


