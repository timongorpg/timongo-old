@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Ranking</div>
    <div class="panel-body">

        <table class="table ranking">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Level</th>
                    <th>Classe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $ranked)
                    <tr>
                        <td>
                            <img src="{{ $ranked->picture }}" alt="{{ $ranked->nickname }}" class="img-responsive img-rounded">
                        </td>
                        <td>{{ $ranked->nickname }}</td>
                        <td><span class="label label-success">{{ $ranked->level }}</span></td>
                        <td>{{ $ranked->profession->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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