<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FoodMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Fetching the food menu data items from the database
        $foodMenus = foodMenu::all();
        // Pass the data to the view
        return view('food-menu.index', compact('foodMenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the form view
        return view('food-menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'code' => 'required|string|max:255|unique:food_menus,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        FoodMenu::create($request->only(['code', 'name', 'description', 'price']));

        return redirect()->route('food-menu.index')->with('success', 'Food menu item added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodMenu $foodMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $foodMenu = FoodMenu::findOrFail($id);
        return view('food-menu.edit', compact('foodMenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'code' => 'required|string|max:255|unique:food_menus,code,'.$id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $foodMenu = FoodMenu::findOrFail($id);
        $foodMenu->update($request->only(['code', 'name', 'description', 'price']));

        return redirect()->route('food-menu.index')->with('success', 'Food menu item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $foodMenu = FoodMenu::findOrFail($id);
        $foodMenu->delete();

        return redirect()->route('food-menu.index')->with('success', 'Food menu item deleted successfully!');
    }
}
