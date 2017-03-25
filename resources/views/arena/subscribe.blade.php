@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Arena</div>
    <div class="panel-body">
        <p>Participantes de mesmo nível: {{ $arena->participants->count() }}</p>

        <form method="POST" action="/arena">
            {{ csrf_field() }}
            <button class="btn btn-info">Entrar por {{ $arena->getCost() }} Ouro</button>
        </form>
    </div>
</div>
@endsection
