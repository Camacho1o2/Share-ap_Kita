<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\IngredientList;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $recipes = Recipe::where('user_id', auth()->id())->get();
        return view('profile', compact('recipes'));

    }

    public function show($id)
{
    // Load the post along with its user and the associated ingredient lists and their ingredients
    $post = Post::with(['user', 'ingredientLists.ingredients'])->findOrFail($id);

    // Return the view with the post data
    return view('content.show', compact('post'));
}



    public function create()
    {
        // Show form to create a post
        return view('content.recipeadd');
    }

    public function store(Request $request)
{
    // Validate the input data
    $request->validate([
        'recipe_name' => 'required|string|max:255',
        'cuisine' => 'required|string|max:255',
        'main_ingredient' => 'required|string|max:255',
        'recipe_type' => 'required|string|max:255',
        'ingredients' => 'required|array',
        'quantities' => 'required|array',
        'estimated_budget' => 'required|numeric',
        'estimated_prep_time' => 'required|string',
        'estimated_cooking_duration' => 'required|string',
        'estimated_serving_size' => 'required|numeric',
        'recipe_description' => 'required|string|min:10'
    ]);

    // Retrieve the authenticated user's ID
    $userId = auth()->id();

    // Create the post (recipe) first
    $post = Post::create([
        'user_id' => $userId,
        'recipe_name' => $request->recipe_name,
        'cuisine' => $request->cuisine,
        'main_ingredient' => $request->main_ingredient,
        'recipe_type' => $request->recipe_type,
        'estimated_budget' => $request->estimated_budget,
        'estimated_prep_time' => $request->estimated_prep_time,
        'estimated_cooking_duration' => $request->estimated_cooking_duration,
        'estimated_serving_size' => $request->estimated_serving_size,
        'recipe_description' => $request->recipe_description
    ]);

    // Insert ingredients and ingredient_list associations
    foreach ($request->ingredients as $index => $ingredient) {
        // Check if the ingredient already exists
        $existingIngredient = Ingredient::where('ingredient_name', $ingredient)->first();

        if ($existingIngredient) {
            $ingredientId = $existingIngredient->id;
        } else {
            $ingredientId = Ingredient::create([
                'ingredient_name' => $ingredient,
            ])->id;
        }

        // Insert into ingredient_lists
        DB::table('ingredient_lists')->insert([
            'ingredient_quantity' => $request->quantities[$index],
            'ingredient_id' => $ingredientId,
            'post_id' => $post->id, // Link to the post
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->route('user.profile')->with('success', 'Recipe posted successfully!');
}


// Log::error($e->getMessage());

    public function edit(Post $post)
    {
    // Eager load the ingredientList and its ingredients
    $post->load('ingredientLists.ingredients');

    return view('content.recipeedit', compact('post'));
    }



    public function update(Request $request, Post $post)
{
    // Validate the input data
    $validated = $request->validate([
        'recipe_name' => 'required|string|max:255',
        'cuisine' => 'required|string|max:255',
        'main_ingredient' => 'required|string|max:255',
        'recipe_type' => 'required|string|max:255',
        'ingredients' => 'required|array',
        'quantities' => 'required|array',
        'estimated_budget' => 'required|numeric',
        'estimated_prep_time' => 'required|string',
        'estimated_cooking_duration' => 'required|string',
        'estimated_serving_size' => 'required|numeric',
        'recipe_description' => 'required|string|min:10'
    ]);

    // Update the post data
    $post->update([
        'recipe_name' => $validated['recipe_name'],
        'cuisine' => $validated['cuisine'],
        'main_ingredient' => $validated['main_ingredient'],
        'recipe_type' => $validated['recipe_type'],
        'estimated_budget' => $validated['estimated_budget'],
        'estimated_prep_time' => $validated['estimated_prep_time'],
        'estimated_cooking_duration' => $validated['estimated_cooking_duration'],
        'estimated_serving_size' => $validated['estimated_serving_size'],
        'recipe_description' => $validated['recipe_description'],
    ]);

    return redirect()->route('content.profile')->with('success', 'Post updated successfully!');
}

public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('user.profile')->with('success', 'Post deleted successfully!');
}

}
