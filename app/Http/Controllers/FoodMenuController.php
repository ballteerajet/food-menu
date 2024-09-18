<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use Illuminate\Http\Request;

class FoodMenuController extends Controller
{
    public function index()
    {
        return response()->json(FoodMenu::all());
    }

    public function store(Request $request)
    {
        $items = $request->all(); // Get the array of items from the request

        // Validate each item
        $validatedItems = array_map(function ($item) {
            return validator()->make($item, [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
            ])->validate();
        }, $items);

        // Create items
        $createdItems = array_map(function ($item) {
            return FoodMenu::create($item);
        }, $validatedItems);

        return response()->json($createdItems, 201);
    }


    public function show($id)
    {
        $foodMenu = FoodMenu::find($id);
        if (!$foodMenu) {
            return response()->json(['message' => 'Food Menu not found'], 404);
        }
        return response()->json($foodMenu);
    }

    public function update(Request $request, $id)
    {
        $foodMenu = FoodMenu::find($id);
        if (!$foodMenu) {
            return response()->json(['message' => 'Food Menu not found'], 404);
        }
        $foodMenu->update($request->all());
        return response()->json($foodMenu);
    }

    public function destroy($id)
    {
        $foodMenu = FoodMenu::find($id);
        if (!$foodMenu) {
            return response()->json(['message' => 'Food Menu not found'], 404);
        }
        $foodMenu->delete();
        return response()->json(null, 204);
    }
}