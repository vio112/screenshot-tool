@extends('layouts.app')


@section('content')
	{!! Form::open(['url' => '/blogs', 'class' => 'form-horizontal', 'role' => 'form']) !!}
		<div class="form-group">
			{!! Form::label('title', 'Title: ', array('class' => 'control-label sr-only')) !!}
			<div class="col-sm-6">
				{!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Enter Title', )) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('content', 'Content: ', array('class' => 'control-label sr-only')) !!}
			<div class="col-sm-6">
				{!! Form::textarea('content', null, array('class' => 'form-control', 'placeholder' => 'Enter your content here...', )) !!}
			</div>
		</div>

		<div class="form-group"> 
			<div class="col-sm-4">
			 	{!! Form::submit('Add Blog', array('class' => 'btn btn-primary')) !!}
			</div>
		</div>
	{!! Form::close() !!}
@stop


