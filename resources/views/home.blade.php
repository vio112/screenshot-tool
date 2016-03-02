@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="row">
                            {{ Form::open(array('url' => '/screenShot')) }}
                                <div class="form-group">
                                    <label for="comment">Domain:</label>
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <textarea name="textarea" class="form-control" rows="5" id="comment" placeholder="Enter Domains here.."></textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</d iv>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
