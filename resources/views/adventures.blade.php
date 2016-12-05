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
                            <img src="{{ $creature->image }}" alt="{{ $creature->name }}">
                        </td>
                        <td>
                            {{ $creature->name }}
                        </td>
                        <td>
                            <button onClick="setCreature({{ $creature->id }})" class="btn btn-danger">Fight</button>
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
