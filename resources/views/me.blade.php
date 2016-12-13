@extends('layouts.app')

@section('content')
    @if($user->hasEnoughExperience())
        <div class="panel panel-default">
            <div class="panel-heading">Level Up</div>
            <div class="panel-body">
                <div class="alert alert-info"><strong>Você conseguiu! </strong>Bem vindo ao próximo level.</div>
            </div>
        </div>
    @endif

    @if($user->level > 1 && $user->profession_id == 1)
        @include('profession-selector')
    @endif

<div class="panel panel-default">
    <div class="panel-heading">Habilidades</div>
    <div class="panel-body">
        <div class="alert alert-info">{{ $masteryTip }}</div>

        <form action="{{ url('mastery') }}" method="POST" id="mastery-form">
            {{ csrf_field() }}
            <input type="hidden" name="mastery_id">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Habilidade</th>
                    <th>Level</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($masteries as $mastery)
                <tr>
                    <td>{{ trans('masteries.' . $mastery->id) }} <a role="button" tabindex="0" data-trigger="focus" data-content="{{ trans('masteries.help.' . $mastery->id) }}" data-toggle="popover" ><span class="glyphicon glyphicon-question-sign"></span></a></td>
                    <td>{{ $user->getTitleName($user->{$mastery->field}) }} <span class="label label-success">{{ $user->{$mastery->field} }}</span></td>
                    <td>
                        @if($user->mastery_points && ! $user->isTraining())
                            <button onClick="setMastery({{ $mastery->id }})" class="btn btn-success">{{ trans('buttons.train') }}</button>
                        @endif

                        @if($user->isTraining($mastery->id))
                            @if($user->trainFinished())
                                <form action="{{ url('/train') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-success">{{ trans('buttons.finish') }}</button>
                                </form>
                            @else
                                {{ $user->end_training->diffForHumans(null, true) }} left
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function setMastery(masteryId) {
            document.querySelector('[name=mastery_id]').value = masteryId;
            document.querySelector('#mastery-form').submit();
        }

        $(function () {
          $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection