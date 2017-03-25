<?php

describe('HomeController', function () {
    describe('@index', function () {
        context('when logged out', function () {
            it('should return status 200', function () {
                $response = $this->laravel->get('/');

                expect($response->getStatusCode())->toEqual(200);
            });
        });

        context('when logged in', function () {
            beforeEach(function () {
                $this->laravel->actingAs(new App\User());
            });

            it('should redirect to GameController@profile with status 302', function () {
                $response = $this->laravel->get('/');

                $response->assertRedirect('/me');
                expect($response->getStatusCode())->toEqual(302);
            });
        });
    });

    describe('@privacy', function () {
        it('should return status 200', function () {
            $response = $this->laravel->get('/privacy');

            expect($response->getStatusCode())->toEqual(200);
        });
    });
});
