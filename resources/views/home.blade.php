@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 601.4px;">

<div class="row justify-content-center">
<h1 class="m-0">Recipes</h1>
    <dic class="col-md-8">
    @if ($errors->any())
<div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>
@endif
    <div class="col-md-8">
    @foreach($posts as $post)
    <div class="card card-widget">
        <div class="card-header">
            <div class="user-block">
                <img class="img-circle" src="dist/img/user1-128x128.jpg" alt="User Image">
                <span class="username">
                    <a href="#">{{ $post->user->name ?? 'Anonymous' }}</a>
                </span>
                <span class="description">Updated at - {{ $post->updated_at->format('M d, Y h:i A') }}</span>
            </div>
            <img class="img-fluid pad" src="dist/img/photo2.png" alt="Photo">
        </div>
        <div class="card-body">
        <a href="{{ route('posts.show', $post->id) }}">
            <h4>{{ $post->recipe_name }}</h4>
        </a>
            <p>{{ $post->recipe_description }}</p>
            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
            <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>

        </div>
    </div>
    @endforeach
    </div>

</div>
        @endsection


