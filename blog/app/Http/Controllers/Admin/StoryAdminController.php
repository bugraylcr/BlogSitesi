<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoryAdminController extends Controller
{
    public function index()
    {
        $stories = Story::latest('published_at')->latest()->get();

        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.stories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:stories,slug',
            'category' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'cover_image_url' => 'nullable|url',
            'published_at' => 'nullable|date',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Story::create($data);

        return redirect()->route('admin.stories.index')->with('status', 'Hikaye kaydedildi.');
    }
}


