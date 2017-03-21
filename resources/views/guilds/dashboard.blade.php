@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
    <div class="panel-heading">{{ trans('sections.guild') }} {{ $guild ? $guild->name : null }} <span class="label label-info">{{ $guild->level }}</span></div>
    <div class="panel-body">
        @unless($members->isEmpty())
            <ul class="list-group">
                @foreach($members as $member)
                    <li class="list-group-item">{{ $member->nickname }}
                        @if($member->id == $guild->leader_id)
                            <span class="label label-success">leader</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endunless

        @unless($candidates->isEmpty())
        <h4>Candidatos</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Classe</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($candidates as $candidate)
                    <tr>
                        <td><img src="{{ $candidate->picture }}" alt="{{ $candidate->nickname }}"></td>
                        <td>{{ $candidate->nickname }}</td>
                        <td>{{ $candidate->getProfessionName() }}</td>
                        <td>{{ $candidate->level }}</td>
                        <td>
                            <form method="POST" action="guild/{{ $candidate->id }}/accept">
                                {{ csrf_field() }}
                                <button class="btn btn-info">Aceitar</button>
                            </form>

                            <form method="POST" action="guild/{{ $candidate->id }}/decline">
                                {{ csrf_field() }}
                                <button class="btn btn-danger">Negar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Nenhum candidato.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        @endunless
    </div>
@endsection
