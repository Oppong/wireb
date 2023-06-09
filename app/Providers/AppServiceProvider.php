<?php

namespace App\Providers;

// use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Builder::macro('toCsv', function(){

            $results = $this->get();

            if($results->count() < 1) return;

            $titles = implode(', ', array_keys((array) $results->first()->getAttributes()));

            $values = $results->map(function ($result) {

                return implode(',', collect($result->getAttributes()) ->map(function ($thing){
                    return '"'.$thing.'"';
                })->toArray());

            });

            $values->prepend($titles);
            return $values->implode("\n");

        });
    }
}
