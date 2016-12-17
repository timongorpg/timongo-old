@servers(['web' => ['deploy@timongo.server']])


@task('deploy', ['on' => 'web'])
    cd timongo

    @if ($branch)
        git pull origin {{ $branch }}
    @else
        git pull origin master
    @endif

    composer install
    php artisan migrate --force

    @if($seed)
        php artisan db:seed
    @endif
@endtask

@task('reinstall', ['on' => 'web'])
    cd timongo

    @if ($branch)
        git pull origin {{ $branch }}
    @else
        git pull origin master
    @endif

    php artisan migrate:refresh --seed
@endtask

@task('creatures', ['on' => 'web'])
    cd timongo
    php artisan db:seed --class=CreatureTableSeeder --force
@endtask