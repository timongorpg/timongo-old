@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Notificações</div>
    <div class="panel-body">
        @foreach ($notifications as $notification)
            <div class="alert alert-{{ array_get($notification->data, 'alert', 'info') }}">
                <p>
                    {{ $notification->data['message'] }}
                    <span class="pull-right">
                        <span class="label label-info">{{ $notification->created_at->diffForHumans() }}</span>
                    </span>
                </p>
            </div>
        @endforeach
    </div>
</div>
@endsection
