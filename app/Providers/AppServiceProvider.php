<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191); // Adjust the length as needed

        // $roles = Role::with('permissions')->get();
        // $permissionsArray = [];
        // foreach ($roles as $role) {
        //     foreach ($role->permissions as $permissions) {
        //         $permissionsArray[$permissions->name][] = $role->id;
        //     }
        // }

        // // Every permission may have multiple roles assigned
        // foreach ($permissionsArray as $name => $roles) {
        //     Gate::define($name, function ($user) use ($roles) {
        //         // We check if we have the needed roles among current user's roles
        //         return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
        //     });
        // }
    }
}
