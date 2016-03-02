@extends('layouts\app')
@section('content')
<script src="http://cdn.alloyui.com/3.0.1/aui/aui-min.js"></script>
<link href="http://cdn.alloyui.com/3.0.1/aui-css/css/bootstrap.min.css" rel="stylesheet"></link>


@unless(Auth::guest() || Auth::user()->admin==0)
<form method="POST" action="{{ url('documents/upload')}}" enctype='multipart/form-data'>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div style="height:0px;overflow:hidden">
   <input type="file" id="fileInput" name="fileInput" />
</div>
<div style="width:180px;float:left position: relative;">
<button type="button" onclick="chooseFile();">Upload A File</button><br><br>
<input  type="submit" value="Submit File">
</div>
</form>
@endunless

<div id="myGallery" class="gallery_display">
@foreach ($docs as $doc)

	<div class="gallery_img">
	<embed src="docs/{{$doc->name}}" width=300 height=100></embedd>
	@unless(Auth::guest() || Auth::user()->admin==0)
	<form method="POST" action="{{ url('/documents/delete',$doc->id) }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="iksic">
	<input type="image" src="/img/iksic.png" name"Submit" alt="Submit" style="height:100%;width:100%;">
	</div>
	</form>
	@endunless
</div>
@endforeach
</div>
<script>
   function chooseFile() {
      $("#fileInput").click();
   }
</script>

 @stop