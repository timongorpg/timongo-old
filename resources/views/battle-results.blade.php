@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">Battle Results</div>
        <div class="panel-body">
            <form method="POST">
                {{ csrf_field()}}
                <input type="hidden" name="creature_id" value="{{ $creature_id }}">

                <div class="clearfix">
                    <button class="btn btn-success pull-right"><span class="glyphicon glyphicon-refresh"></span> Fight again!</button>
                </div>
            </form>

            @foreach(array_get($log, 'fight') as $message)
                <div class="alert {{ $message['hero'] ? 'alert-info' : 'alert-warning'}} clearfix">
                    @if($message['hero'])
                        <img src="/img/icons/attack.png" class="battle-icon" alt="">
                        </object>
                    @endif

                    {!! $message['message'] !!}
                </div>
            @endforeach

            @if($log['results']['win'])
                <div class="alert alert-success">
                    <p>{{ $log['results']['message'] }} You have earned <strong>{{ $log['results']['gold'] }} gold piece(s)</strong>.</p>
                </div>

                <div class="alert alert-success">
                    You have earned <strong>{{ $log['results']['experience'] }} points of experience</strong>.
                </div>
            @else
                <div class="alert alert-danger">
                    <p>{{ $log['results']['message'] }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section("styles")
    <style>
        .battle-icon {
            height: 20px;
        }

        .btn-success{
            margin-bottom: 10px;
        }
    </style>
@endsection