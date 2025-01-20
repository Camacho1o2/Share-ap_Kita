<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientList extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_quantity',
        'ingredient_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id'); // Assuming the ingredient list also relates to a post
    }

    public function ingredients()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

}

