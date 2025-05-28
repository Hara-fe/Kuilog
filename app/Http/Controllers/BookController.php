<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;


class BookController extends Controller
    {
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
        $books = Book::withTrashed()->get(); // ← 削除済みも含めて取得
        return view('books.index', compact('books'));        }

    /**
     * Show the form for creating a new resource.
     */
        public function create()
        {
        return view('books.create');
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
    $request->validate([
        'title' => 'required|max:255',
        'price' => 'required|numeric'
    ]);
    Book::create($request->only(['title', 'price']));
    return redirect()->route('books.index');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $book = Book::findOrFail($id);
    return view('books.show', compact('book'));
    }


    /**
     * Show the form for editing the specified resource.
     */
  public function edit($id)
    {
    $book = Book::findOrFail($id);
    return view('books.edit', compact('book'));
    }


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $request->validate([
        'title' => 'required|max:255',
        'price' => 'required|numeric'
    ]);
    $book = Book::findOrFail($id);
    $book->update($request->only(['title', 'price']));
    return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
   {
    Book::findOrFail($id)->delete();
    return redirect()->route('books.index')->with('success', '本を削除しました');
}

    public function restore($id)
{
    $book = Book::withTrashed()->findOrFail($id);
    $book->restore();

    return redirect()->route('books.index')->with('success', '本を復元しました');
}


}
