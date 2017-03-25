@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
    <div class="panel-heading">{{ trans('sections.guild') }} {{ $guild ? $guild->name : null }} <span class="label label-info">{{ $guild->level }}</span></div>
    <div class="panel-body">
        @if ($guild->hasEnoughExperience())
            <div class="level-up-button">
                <form action="/guild/level-up" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">
                      <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Level Up
                    </button>
                </form>
            </div>
        @else
        <label for="">Experiência:</label>
        <div class="progress">
            <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="{{ $guild->experience_percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $guild->experience_percentage }}%;">{{ $guild->experience }}/{{ $guild->toNextLevel() }}</div>
        </div>
        @endif
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
