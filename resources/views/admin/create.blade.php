@extends('layouts.app')

@section('content')
<div class="col">
  <div class="card">
    <div class="card-header">
      <h5 class="d-inline">Create new post</h5>
    </div>
    <div class="card-body">
      <form action="{{route("posts.store")}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="title">Title</label>
          <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Insert a title" value="{{old("title")}}">
          @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="content">Content</label>
          <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" cols="30" rows="10" placeholder="Insert your description">{{old("content")}}</textarea>
          @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group form-check">
          <input name="posted" type="checkbox" class="form-check-input" id="published" {{(old("published"))? "checked" : "" }}>
          <label class="form-check-label" for="published">Publish</label>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>

      </form>
    </div>
  </div>
</div>
@endsection