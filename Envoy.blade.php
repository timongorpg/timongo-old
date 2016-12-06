@servers(['web' => ['deploy@timongo.server']])


@task('deploy', ['on' => 'web'])
    cd timongo

    @if ($branch)
        git pull origin {{ $branch }}
    @else
        git pull origin master
    @endif

    php artisan migrate

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