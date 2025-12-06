<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Standing;
use Illuminate\Support\Facades\Storage;

class StandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $standings = Standing::orderBy('pos')->get();
        return view('admin.standings.index', compact('standings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.standings.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pos' => 'required|integer',
            'club' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'main' => 'nullable|integer',
            'menang' => 'nullable|integer',
            'seri' => 'nullable|integer',
            'kalah' => 'nullable|integer',
            'goal' => 'nullable|integer',
            'selisih' => 'nullable|integer',
            'poin' => 'nullable|integer',
            'urutan' => 'nullable|integer',
            'highlight' => 'nullable|boolean',
        ]);
        $data['highlight'] = $request->has('highlight');
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('standings', 'public');
        }
        Standing::create($data);
        return redirect()->route('admin.standings.index')->with('success', 'Data klasemen berhasil ditambah.');
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
        $standing = Standing::findOrFail($id);
        return view('admin.standings.form', compact('standing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        \Log::info('StandingController@update called', ['request' => $request->all(), 'standing_id' => $id]);
        $standing = Standing::findOrFail($id);
        $data = $request->validate([
            'pos' => 'required|integer',
            'club' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'main' => 'nullable|integer',
            'menang' => 'nullable|integer',
            'seri' => 'nullable|integer',
            'kalah' => 'nullable|integer',
            'goal' => 'nullable|integer',
            'selisih' => 'nullable|integer',
            'poin' => 'nullable|integer',
            'urutan' => 'nullable|integer',
            'highlight' => 'nullable|boolean',
        ]);
        $data['highlight'] = $request->has('highlight');
        if ($request->hasFile('logo')) {
            if ($standing->logo) {
                Storage::disk('public')->delete($standing->logo);
            }
            $data['logo'] = $request->file('logo')->store('standings', 'public');
        }
        $standing->update($data);
        return redirect()->route('admin.standings.index')->with('success', 'Data klasemen berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $standing = Standing::findOrFail($id);
        if ($standing->logo) {
            Storage::disk('public')->delete($standing->logo);
        }
        $standing->delete();
        return redirect()->route('admin.standings.index')->with('success', 'Data klasemen dihapus.');
    }
}
