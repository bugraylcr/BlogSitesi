<?php

namespace App\Http\Controllers;

use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::orderByDesc('published_at')->orderByDesc('created_at')->get();

        return view('ana-sayfa', [
            'stories' => $stories,
        ]);
    }

    public function show(string $slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();
        $approvedComments = $story->comments()
            ->where('approved', true)
            ->whereNull('parent_id')
            ->latest()
            ->with(['replies' => function ($q) {
                $q->where('approved', true)->oldest();
            }])
            ->get();

        return view('hikaye-detay', [
            'story' => $story,
            'comments' => $approvedComments,
        ]);
    }
}


