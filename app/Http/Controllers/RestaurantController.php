<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function __construct()
    {
    //    $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant= Restaurant::orderBy('title')->get();
        return $restaurant;
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
            'title'=>'required',
            'address'=>'required',
        ]);

        $restaurant= new Restaurant();
        $restaurant->title=$request->get('title');
        $restaurant->address=$request->get('address');

        return ($restaurant->save()==1)
        ? response()->json(['message'=>'Restaurant Created Successfully!!' ])
        : response()->json(['error'=>'Something went wrong while adding new rastaurant!!'],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Restaurant::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request, [
  
        'title' => 'required',
        'address' => 'required']);

        $restaurant = Restaurant::find($id);
        $restaurant->fill($request->all());

        return ($restaurant->save() !== 1)
        ? response()->json(['message'=>'Restaurant Edited Successfully!!' ])
        : response()->json(['error'=>'Something went wrong while editing Restaurant!!'],500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (\App\Models\Restaurant::destroy($id) == 1) 
        ? response()->json(['message'=>'Restaurant Deleted Successfully!!'], 200) 
        : response()->json(['error' => 'Deleting was not successful'], 500);
    }
}