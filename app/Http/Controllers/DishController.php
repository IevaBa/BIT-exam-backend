<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dish = Dish::with('menu')->orderBy('title')->get();
        return $dish;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDATION 
        $this->validate($request, [
        'title' => 'required', 
        'description' => 'required',
        'menu_id' => 'required'
        ]);

        $dish = new Dish();
        $dish->title=$request->input('title');
        $dish->description=$request->input('description');
        $dish->foto_url=$request->input('foto_url');
        $dish->menu_id=$request->input('menu_id');


        return ($dish->save()==1)
        ? response()->json(['message'=>'Dish Created Successfully!!' ])
        : response()->json(['error'=>'Something went wrong while adding new dish!!'],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Dish::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'title' => 'required',
        'description' => 'required'
    ]);
        
        $dish = Dish::find($id);
        $dish->fill($request->all());

        return ($dish->save() !== 1)
        ? response()->json(['message'=>'Dish Edited Successfully!!' ])
        : response()->json(['error'=>'Something went wrong while editing Dish!!'],500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (\App\Models\Dish::destroy($id) == 1) 
        ? response()->json(['message' => 'Dish Successfully Deleted'], 200)
        : response()->json(['error' => 'Deleting was not successful'], 500);
    }
}