@extends('layouts.app')

@section('content')
<div class="panel panel-default adventure-panel">
    <div class="panel-heading">Pick up a fight! Show 'em who is the best.</div>
    <div class="panel-body">
        <div class="alert alert-info" role="alert">{!! $adventureTip !!}</div>

        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Portrait</th>
                    <th>Creature</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($creatures as $creature)
                    <tr>
                        <td>
                            <img src="{{ $creature->image }}" alt="{{ $creature->name }}" data-toggle="popover" data-trigger="hover" data-placement="right" title="<strong>Attributes</strong>" data-content="<img src='/img/icons/health.png'> {{ $creature->health }} <br> <img src='/img/icons/sword.png'> {{ $creature->attack }} <br> <img src='/img/icons/shield.png'> {{ $creature->armor }}<br> <img src='/img/icons/magic.png'> {{$creature->magic_resistance}}">
                        </td>
                        <td>
                            {{ $creature->name }} <span class="label label-default">Lv. {{ $creature->level }}</span>
                        </td>
                        <td>
                            @if ($user->level == $creature->level)
                            <button onClick="setCreature({{ $creature->id }})" class="btn btn-danger" data-toggle="popover" data-trigger="hover" data-placement="left" title="{{ $creature->name }}" data-content="Worthy opponent.">Fight</button>
                            @elseif ($user->level < $creature->level)
                                <button onClick="setCreature({{ $creature->id }})" class="btn btn-danger" data-toggle="popover" data-trigger="hover" data-placement="left" title="{{ $creature->name }}" data-content="Fight him when you're stronger. Lv. ({{ $creature->level }}) recommended.">Fight</button>
                            @else
                                <button onClick="setCreature({{ $creature->id }})" class="btn btn-danger" data-toggle="popover" data-trigger="hover" data-placement="left" title="{{ $creature->name }}" data-content="You're stronger than this.">Fight</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="/battle" method="POST" id="battle-form">
            {{ csrf_field() }}
            <input type="hidden" name="creature_id" />
        </form>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script>
        function setCreature(creatureId) {
            document.querySelector('[name=creature_id]').value = creatureId;
            document.querySelector('#battle-form').submit();
        }
        $('[data-toggle="popover"]').popover({html:true});
    </script>
@endsection

@section('styles')
    @parent
    <style>
        .adventure-panel img:hover {
            cursor: url('/img/icons/attack.png'), auto;
        }

        tbody tr {
            height: 60px;
        }
    </style>
@endsection
