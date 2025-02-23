<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InvitationCode;

class InvitationCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $codes = InvitationCode::where('used', false)->get(); // Hanya tampilkan kode yang belum digunakan
        return view('admin.invitation_codes', compact('codes'));
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
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:50', // Bisa generate 1-50 kode sekaligus
        ]);

        for ($i = 0; $i < $request->quantity; $i++) {
            InvitationCode::create([
                'code' => Str::upper(Str::random(10)), // Buat kode acak
                'used' => false,
            ]);
        }

        return redirect()->route('invitation.index')->with('success', 'Kode undangan berhasil dibuat!');
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
}
