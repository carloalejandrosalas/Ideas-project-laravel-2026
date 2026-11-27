<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ideas = Auth::user()->ideas;

        return view('pages.home', compact('ideas'));
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

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Auth::user()->ideas()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        Session::flash('success', 'Idea created successfully.');

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        return view('pages.ideas.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        return view('pages.ideas.edit', compact('idea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $idea->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        Session::flash('success', 'Idea updated successfully.');

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        $idea->delete();

        Session::flash('success', 'Idea deleted successfully.');

        return redirect()->route('home');
    }

    /**
     * show the form for deleting the specified resource.
     */
    public function showDelete(Idea $idea)
    {
        return view('pages.ideas.delete', compact('idea'));
    }
}
