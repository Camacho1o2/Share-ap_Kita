@extends('layouts.app')

@section('content')
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">{{ Auth::user()->kitchen_role }}</p>


                <a href="#" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Address</strong>

                <p class="text-muted">
                    {{ Auth::user()->address }}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Date of Birth</strong>

                <p class="text-muted">{{ Auth::user()->date_of_birth  }}</p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i>Brief User Description</strong>

                <p class="text-muted">{{ Auth::user()->user_desc }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="{{ route('posts.create') }}">Post Recipe</a> </li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><p class="nav-link active">Recipes</p> </li>
                </ul>
              </div>

              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                  @foreach ($posts as $post)
    <!-- Post -->
    <div class="post">
        <div class="user-block">
            <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
            <span class="username">
                <a href="#">{{ auth()->user()->name }}</a>
                <a href="#" class="float-right btn-tool" data-toggle="modal" data-target="#deleteModal-{{ $post->id }}"><i class="fas fa-times"></i></a>
            </span>
            <span class="description">Last updated - {{ $post->updated_at->format('F d, Y h:i A') }}</span>
        </div>
        <!-- /.user-block -->
        <h5>
            <a href="{{ route('posts.show', $post->id) }}">{{ $post->recipe_name }}</a>
        </h5>
        <p>
            {{ $post->recipe_description }}
        </p>

        <p>
            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
        </p>

        <!-- Edit and Delete buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>

            <!-- Delete Button -->
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" id="delete-form-{{ $post->id }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this post?')) { document.getElementById('delete-form-{{ $post->id }}').submit(); }">Delete</button>
            </form>
        </div>

        <input class="form-control form-control-sm mt-3" type="text" placeholder="Type a comment">
    </div>
    <!-- /.post -->
@endforeach

                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
