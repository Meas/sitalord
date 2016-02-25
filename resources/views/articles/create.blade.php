@extends ('layouts\app')
@section ('content')
	<div class="container">
	<h1> Write an article</h1>
	<hr/>
		<form method="POST" action="{{ url('/articles/store') }}">
			@include ('articles.form', ['submitButtonText' => 'Add Article', 'body' => '', 'naslov' => '', 'article' => 'false'])
		</form>
	<br>


@include('errors.list')
</div>

<script> 
var d = new Date();
      month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

	document.getElementById('published_at').value = [year, month, day].join('-'); 
</script>
@stop