 @extends ('layouts\app')
 @section('content')
<div class="container">
    <h1>{{ $article->title}} </h1>
    <article>
         {{ $article->body }}
    </article><br>
</div>
@endsection
                  
@section ('put_edit_li')
@if ('http://localhost:7777'.$_SERVER['REQUEST_URI'] == url('/articles/show', $article->id))
    <li><a href="{{ url('/articles/edit', $article->id) }}">Edit</a></li>
@endif
@endsection

