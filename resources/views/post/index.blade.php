@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
          @include('notes')
            <h2> <b>Auth User : {{Auth::id()}}</b> </h2>
            @if($posts !=null)
               @foreach($posts as $post)
                  @can('view-post', $post)
                    <div class="card">
                      <div class="card-body">
                         <h3> <b>Title :</b> {{$post->title}} <b>Author :</b> {{$post->user_id}}</h3>
                         <br>
                         <p>{{$post->text}}</p>

                      </div>
                      <div class="card-footer">
                         <form  action="{{route('posts.destroy',$post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group btn-group-sm">
                                @can('update-post', $post)
                                  <a href="{{route('posts.edit',$post->id)}}" class="btn btn-warning btn-sm">EDIT</a>
                                @endcan
                                @can('delete-post', $post)
                                  <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                                @endcan
                            </div>
                         </form>
                      </div>
                    </div>
                    <br>
                  @endcan
               @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
