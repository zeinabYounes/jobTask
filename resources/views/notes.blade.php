@if(session('success'))

<div class="alert alert-success alert-dismissible fade show " id="alerdS">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong> {{session('success')}}  </strong>
 </div>
@endif
@if(session('fail'))

<div class="alert alert-danger alert-dismissible fade show " id="alerdS">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong> {{session('fail') }} </strong>
 </div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show " id="alerdS">
  <button type="button" class="close" data-dismiss="alert">&times;</button>

<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }} </li>
@endforeach
</ul>
</div>
@endif
