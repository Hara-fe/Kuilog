<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafe;

class CafeController extends Controller
{
    public function index(Request $request)
    {
       $showHidden = $request->has('show_hidden');  // 'show_hidden'パラメータがあるかどうかを確認

    $cafes = Cafe::select('id', 'name', 'is_visible')
        ->when($showHidden, function ($query) {
            // 'show_hidden'がある場合は、非表示カフェも取得
            return $query->where('is_visible', false);
        }, function ($query) {
            // 'show_hidden'がない場合は、表示中のカフェだけを取得
            return $query->where('is_visible', true);
        })
        ->get();

    return view('cafes.index', compact('cafes', 'showHidden'));
    }

    public function create()
    {
        return view('cafes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'prefecture' => 'required',
            'address' => 'required|max:100',
            'review' => 'required|numeric|between:1.0,5.0',
            'is_visible' => 'required|boolean',
        ]);

        // dd($request->all());
        Cafe::create($validated);

        return redirect()->route('cafes.index');
    }

    public function show(string $id)
    {
        $cafe = Cafe::findOrFail($id);
        return view('cafes.show', compact('cafe'));
    }

    public function edit(string $id)
    {
        $cafe = Cafe::findOrFail($id);
        return view('cafes.edit', compact('cafe'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'prefecture' => 'required',
            'address' => 'required|max:100',
            'review' => 'required|numeric|between:1.0,5.0',
            'is_visible' => 'required|boolean',
        ]);

        $cafe = Cafe::findOrFail($id);
        $cafe->update($validated);

        return redirect()->route('cafes.index');
    }

    public function destroy(string $id)
    {
        $cafe = Cafe::findOrFail($id);
        $cafe->delete();

        return redirect()->route('cafes.index');
    }
}
