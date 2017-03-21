@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-6">
                Arena
            </div>
            <div class="col-xs-6">
                <div class="pull-right">
                    A: <span class="label">{{ $user->arena_kills }}</span>
                    D: <span class="label">{{ $user->arena_deaths }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table arena">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Level</th>
                    <th>Abates</th>
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
                                <form method="POST" action="/pvp/{{ $participant->id }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">Lutar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Atualize a página para encontrar oponentes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
