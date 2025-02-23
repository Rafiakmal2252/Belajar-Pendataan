<?php

namespace App\Http\Controllers;

use id;
use App\Models\Reply;
use App\Models\Discus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discussions = Discus::with('user')->latest()->paginate(10);
        return view('discussion.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('discussion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Discus::create([
            'created_by' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('discussion.index')->with('success', 'Diskusi berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discus $discussion)
    {
        $discussion->load('replies.user', 'user');
        return view('discussion.show', compact('discussion'));
    }

    // Simpan balasan diskusi
    public function reply(Request $request, Discus $discussion)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Reply::create([
            'replies_to' => $discussion->id,
            'created_by' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $discussion = Discus::findOrFail($id);
        return view('discussion.edit', compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $discussion = Discus::findOrFail($id);
        $discussion->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('discussion.index')->with('success', 'Diskusi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $discussion = Discus::findOrFail($id);
        $discussion->delete();

        return redirect()->route('discussion.index')->with('success', 'Diskusi berhasil dihapus.');
    }

    
}
