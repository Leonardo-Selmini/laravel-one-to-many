@extends('layouts.app')

@section('content')
<div class="col">
  <div class="card">
    <div class="card-header">
      <h5 class="d-inline">{{$post->title}}</h5>
      @if($post->posted == 0)
      <span class="badge badge-dark">Draft</span>
      @else
      <span class="badge badge-info">Posted</span>
      @endif
    </div>
    <div class="card-body">
      <h6 class="card-subtitle text-muted">{{$post->slug}}</h6>
      <p class="card-text">{{$post->content}}</p>
      <a href="{{route("posts.edit", $post->id)}}">
        <button class="btn btn-link">Edit</button>
      </a>
      <form action="{{route("posts.destroy", $post->id)}}" method="POST">
        @csrf
        @method("DELETE")
        <button type="sumbit" class="btn btn-link">Delete</button>
      </form>
    </div>
  </div>
</div>
@endsection