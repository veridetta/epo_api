<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->paginate(5);
 
        return view('books.index',compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer',
            'author' => 'required',
            'image' => 'required',
            'category' => 'required',
        ]);

        $result = $request->file('image')->storeOnCloudinary('books_cover');
        $filePath = $result->getSecurePath();
        $image_id = $result->getPublicId();

        Book::create([
            'title' => $request->title,
            'release_year' => $request->release_year,
            'author' => $request->author,
            'cover_url' => $filePath,
            'cover_id' => $image_id,
            'category_id' => $request->category,
        ]);
 
        return redirect()->route('books.index')
                        ->with('success','Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'release_year' => 'required|integer',
            'author' => 'required',
        ]);
 
        $book->update($request->all());
 
        return redirect()->route('books.index')
                        ->with('success','Buku berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
 
        return redirect()->route('books.index')
                        ->with('success','Buku Berhasil dihapus');
    }
}
