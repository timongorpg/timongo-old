@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{ trans('sections.guild') }} {{ $guild ? $guild->name : null }}</div>
    <div class="panel-body">
        @if($guild)
            Level {{ $guild->level }}

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
        @else
            <form method="POST" action="{{ route('guild.create') }}">
                <div class="form-group">
                    {{ csrf_field() }}
                    <label for="">Guild name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Guild name">
                </div>
                <div class="form-group clearfix">
                    <button type="submit" class="btn btn-primary pull-right">Create Guild</button>
                </div>
            </form>

            <hr>

            <h3>Apply for a guild</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Guild</th>
                        <th>Owner</th>
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
        @endif
    </div>
</div>
@endsection