<?php

namespace App\Http\Controllers;

use App\Models\IngredientList;
use Illuminate\Http\Request;

class IngredientListController extends Controller
{
    public function index()
    {
        $ingredientLists = IngredientList::with('ingredient')->get();
        return view('ingredientlists.index', compact('ingredientLists'));
    }

    public function create()
    {
        return view('content.recipeadd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'ingredient_quantity' => 'required|numeric|min:1',
        ]);

        IngredientList::create($request->all());

        return redirect()->route('ingredientlists.index')->with('success', 'Ingredient list created successfully.');
    }

    public function show(IngredientList $ingredientList)
    {
        return view('ingredientlists.show', compact('ingredientList'));
    }

    public function edit(IngredientList $ingredientList)
    {
        return view('ingredientlists.edit', compact('ingredientList'));
    }

    public function update(Request $request, IngredientList $ingredientList)
    {
        $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'ingredient_quantity' => 'required|numeric|min:1',
        ]);

        $ingredientList->update($request->all());

        return redirect()->route('ingredientlists.index')->with('success', 'Ingredient list updated successfully.');
    }

    public function destroy(IngredientList $ingredientList)
    {
        $ingredientList->delete();

        return redirect()->route('ingredientlists.index')->with('success', 'Ingredient list deleted successfully.');
    }
}
