<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Collection::macro('translate', function ($fields) {
            return $this->map(function ($item) use ($fields) {
                foreach ((array) $fields as $scope) {
                    $scope = explode('.', $scope);
                    $field = array_shift($scope);
                    if(!$scope) {
                        $item->$field = __($item->$field);
                    }
                    else {
                        if($item->$field instanceof Collection) {
                            $item->$field->translate(implode('.', $scope));
                        }
                        if($item->$field instanceof Model) {
                            $item->$field->{implode('.', $scope)} = __($item->$field->{implode('.', $scope)});
                        }
                    }
                }
                return $item;
            });
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
