@extends('layouts.app')

@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="POST">
  @csrf
  @method('PUT') <!-- This tells Laravel that this is an update request -->
  <div class="content-wrapper" style="min-height: 601.4px;">
    <section class="content">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Recipe</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="recipeName">Recipe Name</label>
                <input type="text" id="recipeName" name="recipe_name" class="form-control" value="{{ old('recipe_name', $post->recipe_name) }}">
              </div>
              <div class="form-group">
                <label for="cuisine">Cuisine</label>
                <input type="text" id="cuisine" name="cuisine" class="form-control" value="{{ old('cuisine', $post->cuisine) }}">
              </div>
              <div class="form-group">
                <label for="mainIngredient">Main Ingredient</label>
                <input type="text" id="mainIngredient" name="main_ingredient" class="form-control" value="{{ old('main_ingredient', $post->main_ingredient) }}">
              </div>
              <div class="form-group">
                <label for="recipeType">Recipe Type</label>
                <input type="text" id="recipeType" name="recipe_type" class="form-control" value="{{ old('recipe_type', $post->recipe_type) }}">
              </div>
              <div class="form-group">
                <label for="recipe_description">Recipe Description</label>
                </br>
                <textarea id="recipe_description" name="recipe_description" rows="4">{{ old('recipe_description', $post->recipe_description) }}</textarea>
                @error('recipe_description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="ingredients">Ingredients</label>
                <div id="ingredientFields">
                  <!-- Pre-fill existing ingredients if available -->
                  @if ($post->ingredientList && $post->ingredientList->ingredients && $post->ingredientList->ingredient->isNotEmpty())
    @foreach ($post->ingredientList->ingredients as $ingredient)
        <div class="input-group mb-2">
            <input type="text" name="ingredients[]" class="form-control" value="{{ $ingredient->ingredient_name }}">
            <input type="number" name="quantities[]" class="form-control" value="{{ $ingredient->pivot->ingredient_quantity ?? '' }}">
            <button type="button" class="btn btn-danger remove-ingredient">Remove</button>

        </div>
    @endforeach
@else
    <p>No ingredients available</p>
@endif

                </div>
                <button type="button" id="addIngredient" class="btn btn-primary mt-2">Add Ingredient</button>
                <script src="{{ asset('js/app.js') }}"></script>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Details</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="estimatedBudget">Estimated Budget</label>
                <input type="number" id="estimatedBudget" name="estimated_budget" class="form-control" value="{{ old('estimated_budget', $post->estimated_budget) }}">
              </div>
              <div class="form-group">
                <label for="prepTime">Estimated Preparation Time (minutes)</label>
                <input type="number" id="prepTime" name="estimated_prep_time" class="form-control" value="{{ old('estimated_prep_time', $post->estimated_prep_time) }}">
              </div>
              <div class="form-group">
                <label for="cookingDuration">Estimated Cooking Duration (minutes)</label>
                <input type="number" id="cookingDuration" name="estimated_cooking_duration" class="form-control" value="{{ old('estimated_cooking_duration', $post->estimated_cooking_duration) }}">
              </div>
              <div class="form-group">
                <label for="servingSize">Estimated Serving Size</label>
                <input type="number" id="servingSize" name="estimated_serving_size" class="form-control" value="{{ old('estimated_serving_size', $post->estimated_serving_size) }}">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Update Recipe" class="btn btn-success float-right">
        </div>
      </div>
    </section>
  </div>
</form>

@endsection
