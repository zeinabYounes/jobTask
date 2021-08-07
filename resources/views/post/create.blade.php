@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4 class="card-title">Create Post</h4></div>

                <div class="card-body">
                  <form class="form-group" action="{{route('posts.store')}}" method="POST">
                    @csrf
                    @include('post.form')
                    <input type="submit" name="Create" class="btn btn-primary" >
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
