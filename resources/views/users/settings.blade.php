@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ trans('menus.settings') }}</div>
    <div class="panel-body">
        <form method="POST" action="{{ url('change-theme') }}">
            {{ csrf_field() }}
            <input type="hidden" name="theme" value="{{ $user->theme == 1 ? 0 : 1}}">
            <button class="btn btn-default" type="submit">Trocar Tema</button>
        </form>
    </div>
</div>
@endsection
