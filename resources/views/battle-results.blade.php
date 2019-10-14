@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">Resultado da Luta</div>
        <div class="panel-body">
            <form method="POST">
                {{ csrf_field()}}
                <input type="hidden" name="creature_id" value="{{ $creature_id }}">

                <div class="clearfix">
                    <button class="btn btn-success pull-right"><span class="glyphicon glyphicon-refresh"></span> Lutar novamente</button>
                </div>
            </form>

            @if($log['results']['win'])
                <div class="alert alert-success">
                    <p>{{ $log['results']['message'] }} Você encontrou <strong>{{ $log['results']['gold'] }} peças de ouro</strong>.</p>
                </div>

                <div class="alert alert-success">
                    Você recebeu <strong>{{ $log['results']['experience'] }} pontos de experiência</strong>.
                </div>
            @else
                <div class="alert alert-danger">
                    <p>{{ $log['results']['message'] }}</p>
                </div>
            @endif

            <h2>Resumo da luta</h2>

            <div class="alert alert-info clearfix">
                <img src="/img/icons/attack.png" class="battle-icon" alt="">
                Total de dano causado: {{ $log['summary']['hero_total_damage'] }}
            </div>

            <div class="alert alert-warning clearfix">
                Total de dano recebido: {{ $log['summary']['opponent_total_damage'] }}
            </div>

            <hr>

            <h2>Turnos da luta</h2>

            <hr>

            <div id="battle-results" class="content mCustomScrollbar"></div>
        </div>
    </div>
@endsection

@section("styles")
    <style>
        .battle-icon {
            height: 20px;
        }

        .btn-success{
            margin-bottom: 10px;
        }
    </style>
@endsection

@section("scripts")
    <script type="text/javascript">
        function addBattleResults (fights) {
            var $battleResultsDiv = $('#battle-results .mCSB_container'),
                currentBattle = 0,
                battleResultInterval = setInterval(function () {
                    var fight = fights[currentBattle];
                    if (currentBattle < Object.entries(fights).length) {
                        var $alert = $('<div/>', { 'class': 'alert clearfix alert-' + (fight.hero ? 'info' : 'warning') });
                        if (fight.hero) {
                            $alert.append($('<img/>', { 'class': 'battle-icon', 'alt': '', 'src': '/img/icons/attack.png' }));
                        }
                        $alert.append(fight.message);
                        $battleResultsDiv.append($alert);
                        currentBattle++;
                    } else {
                        clearInterval(battleResultInterval);
                    }
                    $('#battle-results').mCustomScrollbar('scrollTo', 'last');
                }, 2000);
        }
        $(function () {
            $('#battle-results').mCustomScrollbar({
                setHeight: 250,
                theme: '{{ $user->theme == 1 ? "light-thick" : "minimal-dark" }}',
                alwaysShowScrollbar: true,
                live: true
            });

            addBattleResults(
                {!! json_encode(Arr::get($log, 'fight'), JSON_FORCE_OBJECT) !!}
            )
        });
    </script >
@endsection
