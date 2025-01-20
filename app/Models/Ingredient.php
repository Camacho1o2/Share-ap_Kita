<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_name', // Add this if not already there
    ];

    /**
     * Get the ingredient list that the ingredient belongs to.
     */
    public function ingredientLists()
    {
        return $this->hasMany(IngredientList::class, 'ingredient_id'); // ingredient_id is on the IngredientList model
    }
}


