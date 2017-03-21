@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Arena</div>
    <div class="panel-body">
        @if($arena->isOpen() && ! $isSubscribed)
            <form method="POST" action="/arena">
                {{ csrf_field() }}
                <button class="btn btn-info">Entrar por {{ $arena->getCost() }} Ouro</button>
            </form>
        @endif
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Participantes</div>
    <div class="panel-body">
        <table class="table arena">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Level</th>
                    <th>Vitórias</th>
                    <th>Derrotas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        @forelse ($arena->participants as $participant)
            <tr>
                <td><img src="{{ $participant->picture }}" alt="{{ $participant->nickname }}" class="img-responsive img-rounded"></td>
                <td>{{ $participant->nickname }}</td>
                <td>{{ $participant->level }}</td>
                <td>{{ $participant->arena_kills }}</td>
                <td>{{ $participant->arena_deaths }}</td>
                <td>
                    @if ($participant->id != $user->id)
                        <button class="btn btn-danger">Lutar</button>
                    @else

                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Ninguém se inscreveu para esta arena</td>
            </tr>
        @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
    <style>
        .arena img{
            width: 50px;
        }
    </style>
@endsection