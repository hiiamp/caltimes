<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\TasksRepository::class, \App\Repositories\Eloquent\TasksRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AccessRepository::class, \App\Repositories\Eloquent\AccessRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StatusRepository::class, \App\Repositories\Eloquent\StatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TodoListRepository::class, \App\Repositories\Eloquent\TodoListRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CoworkerRepository::class, \App\Repositories\Eloquent\CoworkerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TempAccessRepository::class, \App\Repositories\Eloquent\TempAccessRepositoryEloquent::class);
        //:end-bindings:
    }
}
