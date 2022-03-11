<?php

namespace App\Http\Controllers;

use App\Models\food;
use App\Models\cat;
use Illuminate\Http\Request;
class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::latest()->paginate(5);
        return view('foods.index',compact('foods'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Cat::get();
        return view('foods.create', compact('cats'));
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
            'soal' => 'required',
            'cat_id' => 'required',
            'a_opsi' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'kunci' => 'required',
            'images' => 'required',
            
        ]);
        $items = array();
        $cove="";
        foreach($request->file('images') as $image){
            $result = $image->storeOnCloudinary('cover');
            $filePath = $result->getSecurePath();
            $image_id = $result->getPublicId(); 
            $items[] = $filePath;
            //$cove.=$filePath."kulbon2021";
        }

        Food::create([
            'soal' => $request->soal,
            'gambar_soal' => $items[0],
            'cat_id' => $request->cat_id,
            'a' => $request->a_opsi,
            'b' => $request->b,
            'c' => $request->c,
            'd' => $request->d,
            'a_gambar' =>$items[1],
            'b_gambar' => $items[2],
            'c_gambar' => $items[3],
            'd_gambar' => $items[4],
            'kunci' => $request->kunci
        ]);
 
        return redirect()->route('foods.soal', $request->cat_id) 
                        ->with('success','Soal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(food $food)
    {
        return view('foods.show',compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(food $food)
    {
        $cats = Cat::get();
        return view('foods.edit',compact('food','cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, food $food)
    {
        $request->validate([
            'name' => 'required',
            'cat_id' => 'required',
            'description' => 'required',
            'address' => 'required',
            'price' => 'required',
            'phone' => 'required',
            'open' => 'required',
            'facility' => 'required',
            'map' => 'required',
        ]);
 
        $food->update($request->all());
 
        return redirect()->route('foods.index')
                        ->with('success','Makanan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(food $food)
    {
        $food->delete();
 
        return redirect()->route('foods.index')
                        ->with('success','Makanan Berhasil dihapus');
    }
    public function list(Request $request)
    {
        $cat = Food::where("cat_id", $request->id)->get();
        return response()->json($cat, 200);
    }
    public function soal($soal)
    {
        $foods = Food::where("cat_id", $soal)->paginate(5);
        return view('foods.soal',compact('foods'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
