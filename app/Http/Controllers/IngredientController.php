<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        // Display all ingredients
        $ingredients = Ingredient::all();
        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        // Show form to create an ingredient
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        // Validate and save a new ingredient
        $validated = $request->validate([
            'ingredient_name' => 'required|string|unique:ingredients,ingredient_name',
        ]);

        Ingredient::create($validated);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully!');
    }

    public function destroy(Ingredient $ingredient)
    {
        // Delete an ingredient
        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', 'Ingredient deleted successfully!');
    }
}

