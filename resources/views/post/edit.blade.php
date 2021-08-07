@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4 class="card-title">Update Post</h4></div>

                <div class="card-body">
                  <form class="form-group" action="{{route('posts.update',$post->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    @include('post.form')
                    <input type="submit" name="Update" class="btn btn-warning" >
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
