@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
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
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti nihil modi blanditiis repudiandae, incidunt, necessitatibus deserunt quod iusto facilis obcaecati possimus soluta culpa minus ad. Quod aut aliquid vitae enim animi sunt atque officiis quis eos, doloremque dignissimos odit rerum necessitatibus molestiae quas numquam, sint ducimus quos qui libero! Sed molestiae enim reiciendis commodi inventore, earum, alias. Eligendi asperiores, error, fugiat ex corporis modi. Cum ex veniam maxime laboriosam, architecto facilis cupiditate optio distinctio velit enim mollitia aut suscipit, alias ab fugiat esse commodi fugit. Reprehenderit quia ab ullam, aliquid facilis voluptatum qui dolorum incidunt minima sed minus quo rerum!</p>
            </div>
        </div>
    </div>
</div>
@endsection
