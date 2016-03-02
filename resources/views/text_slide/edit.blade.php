@extends ('layouts\app')
@section ('content')


<div class="container"><h1>Edit: Slide Text</h1>

<form method="POST" action="{{ url('/text_slide/update')}}" >
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<textarea class="form-control" name="body" style="height:200px;" id='body'>{{$body->text}}</textarea><br>
<input class="btn btn-primary form-control" type="submit" value="Update Text">
</form>

@stop