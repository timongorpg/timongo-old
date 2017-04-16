@extends('layouts.app')

@section('content')
@include('partials.shop')

<style>
    .inventory-cells .col-md-3 {
        border-radius: 10px;
        margin-bottom: 10px;
        text-align: center;
        vertical-align: middle;
        background-color: #f5f5f5;
    }

    .inventory-cells .col-md-3 img{
        padding: 20px 10px;
    }
</style>

<div class="panel panel-default">
    <div class="panel-heading">Inventário</div>
    <div class="panel-body">
        <div class="row">
            {{-- Inventory --}}
            <div class="col-md-6 inventory-cells">
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        {{-- <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt=""> --}}
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt="">
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        {{-- <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt=""> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt="">
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt="">
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        {{-- <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt=""> --}}
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt="">
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        {{-- <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt=""> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        {{-- <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt=""> --}}
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt="">
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        {{-- <img src="https://images.tibiabr.com/Imgs/Conteudo/itens/leather_helmet.gif" alt=""> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit itaque consectetur at voluptatibus ex tempora ducimus quaerat, saepe iure minus facere cum eius assumenda voluptas doloremque nihil eligendi placeat nobis laboriosam molestiae adipisci est minima. Veniam officiis incidunt id! Quae repudiandae vero minima unde libero debitis illo minus aspernatur reprehenderit adipisci quaerat, dicta ex amet, cupiditate ipsa a veniam enim corrupti numquam repellat similique. Iste itaque velit magni error dolores, pariatur ut officiis beatae minima totam, provident doloremque cum quasi. Rerum laborum recusandae nulla repellat suscipit minus porro voluptas eos necessitatibus ipsum, expedita perferendis nam placeat architecto totam ab tempore.</p>
            </div>
        </div>
    </div>
</div>
@endsection