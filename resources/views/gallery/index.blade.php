@extends('layouts\app')
@section('content')
<div class="left_center_align">
<div style="height:0px;overflow:hidden">
   <input type="file" id="fileInput" name="fileInput" />
</div>
<button type="button" class="slider_option_button" onclick="chooseFile();">Upload<br>An<br>Image</button><br><br>
<input class="btn btn-primary form-control" type="submit" value="Submit Image">
</div>
 <script>
   function chooseFile() {
      $("#fileInput").click();
   }
</script>

 @stop