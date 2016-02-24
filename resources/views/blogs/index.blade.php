@extends('layouts.app')

@section('content')
<h1>My Blogs</h1>
	<ul>
	@foreach($user->blogs as $blogs)

		<li>{!! Html::linkAction('BlogsController@show', $blogs->title, array($blogs->id)) !!}</li>
	@endforeach
	</ul>
@stop