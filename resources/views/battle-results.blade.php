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

            @foreach(array_get($log, 'fight') as $message)
                <div class="alert {{ $message['hero'] ? 'alert-info' : 'alert-warning'}} clearfix">
                    @if($message['hero'])
                        <img src="/img/icons/attack.png" class="battle-icon" alt="">
                        </object>
                    @endif

                    {!! $message['message'] !!}
                </div>
            @endforeach
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