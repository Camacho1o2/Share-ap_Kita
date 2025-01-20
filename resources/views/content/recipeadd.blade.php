@extends('layouts.app')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
  @csrf
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
                  <h3 class="card-title">Post a Recipe</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="recipeName">Recipe Name</label>
                    <input type="text" id="recipeName" name="recipe_name" class="form-control" value="Spaghetti Bolognese">
                  </div>
                  <div class="form-group">
                    <label for="cousine">Cuisine</label>
                    <input type="text" id="cuisine" name="cuisine" class="form-control" value="Italian">
                  </div>
                  <div class="form-group">
                    <label for="mainIngredient">Main Ingredient</label>
                    <input type="text" id="mainIngredient" name="main_ingredient" class="form-control" value="Ground Beef">
                  </div>
                  <div class="form-group">
                    <label for="recipeType">Recipe Type</label>
                    <input type="text" id="recipeType" name="recipe_type" class="form-control" value="Main Course">
                  </div>
                  <div class="form-group">
                        <label for="recipe_description">Recipe Description</label>
                        </br>
                        <textarea id="recipe_description" name="recipe_description" rows="4" required></textarea>
                        @error('recipe_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  <div class="form-group">
                    <label for="ingredients">Ingredients</label>
                    <div id="ingredientFields">
                        <div class="input-group mb-2">
                            <input type="text" name="ingredients[]" class="form-control" placeholder="Enter ingredient name">
                            <input type="number" name="quantities[]" class="form-control" placeholder="Quantity">
                            <button type="button" class="btn btn-danger remove-ingredient">Remove</button>
                        </div>
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
                    <input type="number" id="estimatedBudget" name="estimated_budget" class="form-control" value="50">
                  </div>
                  <div class="form-group">
                    <label for="prepTime">Estimated Preparation Time (minutes)</label>
                    <input type="number" id="prepTime" name="estimated_prep_time" class="form-control" value="30">
                  </div>
                  <div class="form-group">
                    <label for="cookingDuration">Estimated Cooking Duration (minutes)</label>
                    <input type="number" id="cookingDuration" name="estimated_cooking_duration" class="form-control" value="60">
                  </div>
                  <div class="form-group">
                    <label for="servingSize">Estimated Serving Size</label>
                    <input type="number" id="servingSize" name="estimated_serving_size" class="form-control" value="4">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <a href="#" class="btn btn-secondary">Cancel</a>
              <input type="submit" value="Post Recipe" class="btn btn-success float-right">
            </div>
          </div>
    </section>
  </div>
</form>

@endsection
