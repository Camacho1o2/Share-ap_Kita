@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 601.4px;">
<section class="content">
    <!-- Check for Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Recipe Detail Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $post->recipe_name }}</h3>
        </div>
        <div class="card-body">
            <h4>Description:</h4>
            <p>{{ $post->recipe_description }}</p>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Estimated Budget</span>
                            <span class="info-box-number text-center text-muted mb-0">{{ $post->estimated_budget }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Prep Time</span>
                            <span class="info-box-number text-center text-muted mb-0">{{ $post->estimated_prep_time }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <h5>Ingredients:</h5>
            <ul>
            @if($post->ingredients->isNotEmpty())
    @foreach ($post->ingredients as $ingredient)
        <li>{{ $ingredient->ingredient_name }}: {{ $ingredient->ingredient_quantity }}</li>
    @endforeach
@else
    <li>No ingredients available.</li>
@endif

            </ul>
        </div>
    </div>
</section>
</div>
@endsection
