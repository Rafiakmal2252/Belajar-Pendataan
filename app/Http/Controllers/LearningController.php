<?php

namespace App\Http\Controllers;

use App\Models\Learning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allLearn = Learning::latest()->get();
        return view('learn.index', compact('allLearn'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('learn.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required',
        ]);

        $summary = [ ...$request->all(), 
        'created_by' => Auth::id() ];

        Learning::create($summary);

        return redirect()->route('learn.index')->with('success', 'Kajian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Learning $learning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $learn = Learning::where('id', $id)->firstOrFail();

        return view('learn.edit', compact('learn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Learning $learn)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required',
        ]);
        
        //  Update Data Kajian
    $learn->update([
        'title' => $request->title,
        'summary' => $request->summary,
    ]);
    
    //  Redirect dengan Pesan Sukses
    return redirect()->route('learn.index')->with('success', 'Kajian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $learn = Learning::find($id);
    
    if (!$learn) {
        return redirect()->back()->with('error', 'Data tidak ditemukan!');
    }

    $learn->delete();

    return redirect()->back()->with('success', 'Kajian berhasil dihapus!');
    }
}
