<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ideas = Idea::all();

        return view('pages.ideas.index', compact('ideas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Idea::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);

        return redirect()->route('ideas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $idea = Idea::findOrFail($id);

        return view('pages.ideas.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $idea = Idea::findOrFail($id);

        return view('pages.ideas.edit', compact('idea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $idea = Idea::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $idea->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        Session::flash('success', 'Idea updated successfully.');

        return redirect()->route('ideas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $idea = Idea::findOrFail($id);
        $idea->delete();

        Session::flash('success', 'Idea deleted successfully.');

        return redirect()->route('ideas.index');
    }

    /**
     * show the form for deleting the specified resource.
     */
    public function showDelete(string $id)
    {
        $idea = Idea::findOrFail($id);

        return view('pages.ideas.delete', compact('idea'));
    }
}
