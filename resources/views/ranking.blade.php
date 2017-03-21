@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Ranking</div>
    <div class="panel-body">
        {{ $users->links() }}
        <table class="table ranking">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Level</th>
                    <th>Arena</th>
                    <th>Classe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $ranked)
                    <tr>
                        <td>
                            <img src="{{ $ranked->picture }}" alt="{{ $ranked->nickname }}" class="img-responsive img-rounded">
                        </td>
                        <td>
                            @if ($ranked->guild)
                                <span class="label label-info">{{ $ranked->guild->name }}</span>
                            @endif
                            {{ $ranked->nickname }}
                        </td>
                        <td><span class="label label-success">{{ $ranked->level }}</span></td>
                        <td>Abates: {{ $ranked->arena_kills }} / Derrotas: {{ $ranked->arena_deaths }}</td>
                        <td>{{ $ranked->getProfessionName() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection

@section('styles')
    <style>
        .ranking img{
            width: 50px;
        }
    </style>
@endsection