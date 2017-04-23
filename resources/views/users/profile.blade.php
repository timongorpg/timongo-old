@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        @if ($profile->guild && $profile->guild->leader_id == $profile->id)
            <span class="label label-success">Guild leader</span>
        @endif
        @if ($profile->guild)
            <span class="label label-info">{{ $profile->guild->name }}</span>
        @endif
        {{ $profile->nickname }}'s profile
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ $profile->picture }}" alt="{{ $profile->nickname }}" class="img-responsive img-rounded">
            </div>
            <div class="col-md-10">
                <p>Level: {{ $profile->level }}</p>
                <p>Profession: {{ $profile->getProfessionName() }}</p>
                <p>Joined: {{ $profile->created_at->diffForHumans() }}</p>
                <p>Last update: {{ $profile->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
