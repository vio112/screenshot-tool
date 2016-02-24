@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @include('partials._blog-list', ['blogs' => $blogs])

                    <?php
                     // echo '<img src="screenshot.php?url=yahoo.ph"/>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
