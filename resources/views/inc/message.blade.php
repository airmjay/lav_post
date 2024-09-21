@if(count($errors) > 0 )
@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-sm p-1">{{$error}}</div>    
@endforeach
@endif
@if(session('success'))
<div class="alert alert-success alert-sm p-1">{{session('success')}}</div> 
@endif   
@if(session('error'))
<div class="alert alert-danger alert-sm p-1">{{session('error')}}</div> 
@endif   

