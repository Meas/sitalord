@extends ('layouts\app')
@section ('content')
@include('slides\slides_menu')
<link href="{{ asset('/css/image-picker.css') }}" rel="stylesheet">
<script src="{{ asset('/js/image-picker.min.js') }}"></script>
<style>
option {
	width:100%;
}
</style>
<form method="POST" action="{{ url('slides/change/slide'.$id)}}" enctype='multipart/form-data'>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="gallery_display2">

<select name='select' class="image-picker show-html">

@foreach ($pictures as $picture)
	@if(substr($picture->name, 0, 4)=='300_')

			<option data-img-src="/img/{{$picture->name}}" value="{{$picture->name}}"></option>

	@endif

@endforeach
</select>
</div>
<div style="width:100%;bottom: 0;position:absolute;">
<input class="btn btn-primary form-control" type="submit" value="select picture">
</div>
</form>


<script>
$("select").imagepicker()
</script>

@stop