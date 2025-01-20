<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimated_budget',
        'estimated_prep_time',
        'estimated_cooking_duration',
        'estimated_serving_size',
        'recipe_name',
        'cuisine',
        'main_ingredient',
        'recipe_type',
        'user_id',
        'ingredient_list_id',
        'recipe_description',
    ];

    // A post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class); // Post belongs to User
    }

    // A post has many ingredient lists
    public function ingredientLists()
    {
        return $this->hasMany(IngredientList::class); // Post has many IngredientLists
    }

    // A post can access all ingredients through the ingredient list
    public function ingredients()
    {
        return $this->hasMany(IngredientList::class, 'post_id'); // post_id is on the IngredientList model
    }
}
