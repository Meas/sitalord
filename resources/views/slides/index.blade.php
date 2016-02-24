@extends ('layouts\app')
@section ('content')
@include('slides\slides_menu')
<div class="slider_option1">
<button class="slider_option_button" onclick="window.location='{{url('slides/gallery_upload') }}';">Upload<br>An<br>Image</button>
</div>
<div class="slider_option2">
<button class="slider_option_button" onclick="window.location='{{url('slides/gallery_upload') }}';">View<br>The<br>Gallery</button>
</div>
@stop