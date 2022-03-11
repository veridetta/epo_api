<?php

namespace App\Http\Controllers;

use App\Models\cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Cat::latest()->paginate(5);
        return view('cats.index',compact('cats'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats.create');
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
            'name' => 'required',
            'image' => 'required',
        ]);

        $result = $request->file('image')->storeOnCloudinary('cover');
        $filePath = $result->getSecurePath();
        $image_id = $result->getPublicId();

        Cat::create([
            'name' => $request->name,
            'cover' => $filePath,
        ]);
 
        return redirect()->route('cats.index')
                        ->with('success','Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(cat $cat)
    {
        return view('cats.show',compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(cat $cat)
    {
        return view('cats.edit',compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cat $cat)
    {
        $request->validate([
            'name' => 'required',
        ]);
 
        $cat->update($request->all());
 
        return redirect()->route('cats.index')
                        ->with('success','Kategori berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(cat $cat)
    {
        $cat->delete();
 
        return redirect()->route('cats.index')
                        ->with('success','Kategori Berhasil dihapus');
    }


    public function list(Request $request)
    {
        $cat = Cat::all();
        return response()->json($cat, 200);
    }
}
