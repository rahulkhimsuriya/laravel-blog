@extends ('layouts.app')

@section ('content')

<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">

    <div class="card p-5 shadow">

      <h3 class="text-dark mb-5">Update Post</h3>

      <form method="POST" action="/posts/{{$post->id}}/edit" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="form-group">
          <label for="post-title">Post Title</label>
          <input type="text" class="form-control @error ('title') is-invalid @enderror" id="post-title" placeholder="Post Title" name="title" value="{{ $post->title }}">
          @error ('title')
          <p class="text-danger p-2">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="image">Image Upload</label>
          <input type="file" class="form-control-file" name="image" id="image">
          @error ('image')
          <p class="text-danger p-2">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="post-excert">Post Excerpt</label>
          <textarea class="form-control @error ('excerpt') is-invalid @enderror" id="post-excert" rows="3" name="excerpt" placeholder="Enter Post Excerpt">{{ $post->excerpt }}</textarea>
          @error ('excerpt')
          <p class="text-danger p-2">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="post-body">Post body</label>
          <textarea class="form-control @error ('body') is-invalid @enderror" id="post-body" rows="5" name="body" placeholder="Enter Post Body">{{ $post->body }}</textarea>
          @error ('body')
          <p class="text-danger p-2">{{ $message }}</p>
          @enderror
        </div>

        <button type="submit" class="btn btn-success btn-lg">SAVE CHANGES <i class="far fa-save"></i></button>
      </form>
    </div>

  </div>
</div>

@endsection