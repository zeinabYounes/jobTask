@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @include('notes')
        <div class="col-md-8 p-10">
          @if($users != null)
            @foreach($users as $user)
              @if($user->role_id !==1)
                @if(Auth::id() !== $user->id)
                  @foreach($friends as $friend)
                    @if($friend->id ==$user->id)
                       <div class="card mb-16">
                          <div class="card-body">
                             <b>NAME :{{$user->name}}  ID :{{$user->id}}</b>
                             <!-- <a href="{{route('users.follow',$user->id)}}" class="btn btn-block btn-sm btn-primary">unFollow</a> -->
                          </div>
                          @php
                            continue 2;
                          @endphp
                       </div>
                       
                    @else

                    @continue

                    @endif
                  @endforeach
                  <div class="card mb-16">
                    <div class="card-body">
                       <b>NAME :{{$user->name}}  ID :{{$user->id}}</b>
                       <a href="{{route('users.follow',$user->id)}}" class="btn btn-block btn-sm btn-primary">Follow</a>
                    </div>
                  </div>

                @endif
              @endif
             @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
