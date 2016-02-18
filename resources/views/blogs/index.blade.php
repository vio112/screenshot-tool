@extends('layouts.app')

@section('content')
<h1>Welcome to Blog Page</h1>
	<ul>
	@foreach($blogs as $blog)
		<!-- <li>{!! link_to_action('BlogsController@show', $title = $blog->title, $parameters = array($blog->id), $attributes = array()) !!}</li> -->
		<li>{!! Html::linkAction('BlogsController@show', $blog->title, array($blog->id)) !!}</li>
	@endforeach
	</ul>
@stop