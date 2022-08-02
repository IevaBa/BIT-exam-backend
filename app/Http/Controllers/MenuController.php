<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
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
        $menu = Menu::with('restaurant')->orderBy('title')->get();
        return $menu;
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
        'title' => 'required |unique:menus,title', 
        'restaurant_id' => 'required'
        ]);

        $menu = new Menu();
        $menu->title=$request->input('title');
        $menu->restaurant_id=$request->input('restaurant_id');


        return ($menu->save()==1)
        ? response()->json(['message'=>'Menu Created Successfully!!' ])
        : response()->json(['error'=>'Something went wrong while adding new menu!!'],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Menu::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'title' => 'required|unique:menus,title, '.$id.',id',]);
        
        $menu = Menu::find($id);
        $menu->fill($request->all());

        return ($menu->save() !== 1)
        ? response()->json(['message'=>'Menu Edited Successfully!!' ])
        : response()->json(['error'=>'Something went wrong while editing Menu!!'],500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return (\App\Models\Menu::destroy($id) == 1) 
        ? response()->json(['message' => 'Menu Successfully Deleted'], 200)
        : response()->json(['error' => 'Deleting was not successful'], 500);
    }
}