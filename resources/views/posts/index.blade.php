@extends ('layouts.app')

@section ('content')

<ul class="list-unstyled">

  <div class="row justify-content-md-center justify-content-lg-start">
    @forelse ($posts as $post)
    <div class="col-md-8 col-lg-6">
      <li class="media p-3 mb-3 shadow-sm">
        <img src="/storage/images/{{ $post->image_url }}" class="mr-3 my-auto" alt="Post Image">
        <div class="media-body">
          <h5 class="mt-0 mb-1">{{$post->title}}</h5>
          {{$post->excerpt}}
        </div>
        <div class="mr-auto mt-auto">
          <a href="{{ route('posts.show', ['post'=> $post->id]) }}" class="btn btn-link text-info">Read More</a>
        </div>
      </li>
    </div>
    @empty
    <div class="col-12">
      <div class="jumbotron text-center w-100">
        <h1 class="display-4">No Posts</h1>
      </div>
    </div>

    @endforelse

  </div>

</ul>

@endsection