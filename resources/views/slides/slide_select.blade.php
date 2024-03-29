@extends ('layouts\app')
@section ('content')
@include('slides\slides_menu')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<div class="container">
<h1 style="text-align: center;font-size: 6vmin"> Slide {{ $id }}</h1>
</div>
<div class="slider_option1">
<form method="POST" action="{{ url('slides/upload', $id )}}" enctype='multipart/form-data'>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div style="height:0px;overflow:hidden">
   <input type="file" id="fileInput" name="fileInput" />
</div>
<div id="button1">
<button type="button" class="slider_option_button" onclick="chooseFile();">Upload<br>An<br>Image</button><br><br>
<input class="btn btn-primary form-control" type="submit" value="Submit Image">
</div>
</form>
</div>
<div id="button2">
<div class="slider_option2">
<button class="slider_option_button" onclick="window.location='{{url('slides/select_from_gallery/slide').$id }}';">Select<br>From<br>Gallery</button>
</div>
</div>
@include('errors.list')
<script>
   function chooseFile() {
      $("#fileInput").click();
   }
</script>
@stop