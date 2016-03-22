@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1 style="text-align: center">Screenshot Tool</h1>
            <!-- <div class="panel panel-default"> -->
                <!-- <div class="panel-heading">Domain:</div> -->

                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="row">
                            {{ Form::open(array('url' => '/screenShot')) }}
                                <div class="form-group">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <textarea name="textarea" class="form-control" rows="10" id="comment" placeholder="Input Domains here..."></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="radio">
                                                    <label><input type="radio" name="screenOption" value="all" checked="checked">All Screenshots</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="screenOption" value="current">Most Recent Screenshot</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="row">
                                                <button style="float: right; margin-top: 20px;" type="submit" class="btn btn-primary btn-md">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
