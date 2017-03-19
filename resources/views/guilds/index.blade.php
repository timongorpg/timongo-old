@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ trans('sections.guild') }}</div>
    <div class="panel-body">
        <form method="POST" action="{{ route('guild.create') }}">
            <div class="form-group">
                {{ csrf_field() }}
                <label for="">Guild name</label>
                <input type="text" name="name" class="form-control" placeholder="Escolha um nome para guild">
            </div>
            <div class="form-group clearfix">
                <button type="submit" class="btn btn-primary pull-right">Criar Guild</button>
            </div>
        </form>

        <hr>

        <h3>Aplicar para uma guild</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Guild</th>
                    <th>Dono</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($availableGuilds as $availableGuild)
                    <tr>
                        <th>{{ $availableGuild->name }}</th>
                        <th>{{ $availableGuild->leader->nickname }}</th>
                        <th>
                            <form method="POST" action="{{ route('guild.apply', $availableGuild->id) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success">Apply</button>
                            </form>
                        </th>
                    </tr>
                @empty
                    <tr>
                        <th>No guilds available.</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection