@extends('layouts.app')

@section('content')
<h1>{{ $blogs->title }}</h1>
<h3>{{ $blogs->content}}</h3>
@stop