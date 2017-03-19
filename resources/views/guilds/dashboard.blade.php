@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
    <div class="panel-heading">{{ trans('sections.guild') }} {{ $guild ? $guild->name : null }} <span class="label label-info">{{ $guild->level }}</span></div>
    <div class="panel-body">
        @unless($members->isEmpty())
            <ul>
                @foreach($members as $member)
                    <li>{{ $member->nickname }}
                        @if($member->id == $guild->leader_id)
                            <span class="label label-success">leader</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endunless

        <h4>Candidatos</h4>
        @unless($candidates->isEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($candidates as $candidate)
                    <tr>
                        <td><img src="{{ $candidate->picture }}" alt=""></td>
                        <td>{{ $candidate->nickname }}</td>
                        <td>{{ $candidate->level }}</td>
                        <td>
                            <form action="guild/accept/{{ $candidate->id }}">
                                <button class="btn btn-info">Aceitar</button>
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
