@extends ('layouts.app')

@section ('content')

@include ('layouts.backButton')

<div class="row justify-content-center mb-5">

  <div class="col-md-8 col-lg-8">

    <div class="card shadow">
      <img src="/storage/images/{{ $post->image_url }}" class="card-img-top" alt="Post Image">

      <div class="card-body">
        <h3 class="card-title">{{$post->title}}</h5>
          <div class="row">
            <div class="col-md-7">
              <p>
                Created at : {{$post->created_at}}
              </p>
              <p>
                Update at : {{$post->updated_at}}
              </p>
            </div>
            @if (auth()->user()->id === $post->user_id)
            <div class="col-md-5">
              <a href="/posts/{{$post->id}}/edit" class="btn btn-warning my-1">Update <i class="far fa-edit"></i></a>
              <button class="btn btn-outline-danger my-1" data-toggle="modal" data-target="#deleteModal">Delete <i class="far fa-trash-alt"></i></button>
            </div>
            @endif
          </div>
      </div>

      <div class=" card-body">
        <p class="card-text">{{$post->excerpt}}</p>
        <p class="lead card-text">{{$post->body}}</p>
      </div>

    </div>

  </div>
</div>


@if (auth()->user()->id === $post->user_id)
<div class="modal fade" role="dialog" id="deleteModal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this post?</p>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="/posts/{{$post->id}}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary">Yes</button>
        </form>
      </div>


    </div>
  </div>
</div>

@endif

@endsection