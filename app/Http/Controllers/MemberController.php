<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(
                AdminMiddleware::class,
                only: ['create', 'store', 'edit', 'update', 'destroy']
            ),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query("search");
        $division = $request->query("division");

        $allMember = Member::query();

        if ($request->has('division') && !empty($request->division)) {
            $allMember->where('division', $request->division);
        }

        if ($request->has('search') && !empty($request->search)) {
            $allMember->where(function ($m) use ($request) {
                $m->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%')
                  ->orWhere('id_rohis', 'like', '%' . $request->search . '%');
            });
        }

        $allMember = $allMember->get();

        $divisions = Member::select('division')->distinct()->get();

        return view('member.index', compact('allMember', 'divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "id_rohis" => "required|numeric|digits:6",
            "name" => "required|regex:/^[\pL\s]+$/u",
            "division" => "required|alpha",
            "class" => "required|alpha_num",
            "nis" => "required|numeric|digits:5",
        ]);

        $data = [ ...$request->all(), 
        'created_by' => Auth::id() ];

        Member::create($data);

        return redirect()->route('member.index')->with('success', 'Member created successfully.');
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
        $member = Member::where('id_rohis', $id)->firstOrFail();

        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "id_rohis" => "required|numeric|digits:6",
            "name" => "required|regex:/^[\pL\s]+$/u",
            "division" => "required|alpha",
            "class" => "required|alpha_num",
            "nis" => "required|numeric|digits:5",
        ]);

        // process data
        try {
            Member::where('id_rohis', $id)->update([
                'id_rohis' => $request->id_rohis,
                'name' => $request->name,
                'division' => $request->division,
                'class' => $request->class,
                'nis' => $request->nis,
            ]);
        } catch (UniqueConstraintViolationException) {
            return redirect()->back()->with([
                'message' => 'IDR sudah terdaftar'
            ]);
        }

        return redirect()->route('member.index')->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->back()->with('success', 'Member deleted successfully.');
    }
}
