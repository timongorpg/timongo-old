@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">Resultado da Luta</div>
        <div class="panel-body">
            @if (array_get($log, 'results.win'))
                <div class="alert alert-success">
                    Você derrotou {{ $opponent->nickname }}
                </div>
            @else
                <div class="alert alert-danger">
                    Você foi derrotado por {{ $opponent->nickname }}
                </div>

                <div class="alert alert-danger">
                    Você foi retirado da arena
                </div>
            @endif
            <h2>Turnos da luta</h2>

            <hr>

            @foreach(array_get($log, 'fight') as $message)
                <div class="alert {{ $message['hero'] ? 'alert-info' : 'alert-warning'}} clearfix">
                    @if($message['hero'])
                        <img src="/img/icons/attack.png" class="battle-icon" alt="">
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