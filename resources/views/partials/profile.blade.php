<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    {{ trans('profile.hero_lv') }} <span class="badge label-primary" id="profile-level">{{ $user->level }}</span>
                </div>
                <div class="col-xs-6 text-right">
                    <span class="label label-warning">{{ $user->gold }} {{ trans('profile.gold') }}</span>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row profile-pic-row">
                <div class="col-xs-5">
                    <a href="{{ url('/me') }}">

                  <img class="img-responsive img-rounded" src="{{ $user->picture }}" alt="{{ $user->nickname }}">
                    </a>
                </div>
                <div class="col-xs-7">
                    <h4 id="profile-nickname">{{ $user->nickname }}</h4>
                    {{ $user->getProfessionName() }}
                </div>
            </div>

            @if(!$user->isMaxLevel())
            <hr>
            <label for="experience">{{ trans('profile.experience') }}</label>
                @if($user->hasEnoughExperience())

                    <div class="level-up-button">
                        <form action="/level-up" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                              <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Level Up
                            </button>
                        </form>
                    </div>

                @else

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active progress-bar-info" role="progressbar" aria-valuenow="{{ $user->experience_percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $user->experience_percentage }}%;">
                            {{ $user->experience }}/{{ $user->toNextLevel() }}
                        </div>
                    </div>

                @endif
            @endif

            <hr />

            <div class="row potions-row">
                <form action="{{ url('use-potion') }}" method="POST" id="use-potion-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="potion_id">
                </form>
                <div class="col-xs-6" onClick="setUsePotion(1)">
                    <img src="/img/items/life-flask.gif" alt="Life Potion">x{{$user->life_potions}}
                </div>
                <div class="col-xs-6" onClick="setUsePotion(2)">
                    <img src="/img/items/mana-flask.gif" alt="Mana Potion">x{{$user->mana_potions}}
                </div>
            </div>

            <hr>

            <label for="health">{{ trans('profile.health') }}</label>

            <div class="progress">
                <div class="progress-bar health-bar progress-bar-striped active {{ $user->health_percentage > 30 ? 'health-bar-safe' : 'health-bar-danger' }}" role="progressbar" aria-valuenow="{{ $user->health_percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $user->health_percentage }}%;">
                    {{ $user->current_health }}/{{ $user->total_health }}
                </div>
            </div>

            <label for="mana">{{ trans('profile.mana') }}</label>

            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{{ $user->mana_percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $user->mana_percentage }}%;">
                    {{ $user->current_mana }}/{{ $user->total_mana }}
                </div>
            </div>

            <label for="stamina">{{ trans('profile.stamina') }}</label>

            <div class="progress">
                <div class="progress-bar stamina-bar progress-bar-striped active progress-bar-warning" role="progressbar" aria-valuenow="{{ $user->stamina_percentage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $user->stamina_percentage}}%;">
                    {{ $user->current_stamina }}/{{ $user->total_stamina }}
                </div>
            </div>
        </div>
    </div>
</div>
