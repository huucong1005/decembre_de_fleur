<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//define gate_name
//check key_code in database

        Gate::define('list-category',function($user){
            return $user->checkPermissionAccess('list_category');
        });
        Gate::define('add-category',function($user){
            return $user->checkPermissionAccess('add_category');
        });
        Gate::define('edit-category',function($user){
            return $user->checkPermissionAccess('edit_category');
        });
        Gate::define('delete-category',function($user){
            return $user->checkPermissionAccess('delete_category');
        });


        Gate::define('list-brand',function($user){
            return $user->checkPermissionAccess('list_brand');
        });
        Gate::define('add-brand',function($user){
            return $user->checkPermissionAccess('add_brand');
        });
        Gate::define('edit-brand',function($user){
            return $user->checkPermissionAccess('edit_brand');
        });
        Gate::define('delete-brand',function($user){
            return $user->checkPermissionAccess('delete_brand');
        });


        Gate::define('list-product',function($user){
            return $user->checkPermissionAccess('list_product');
        });
        Gate::define('add-product',function($user){
            return $user->checkPermissionAccess('add_product');
        });
        Gate::define('edit-product',function($user){
            return $user->checkPermissionAccess('edit_product');
        });
        Gate::define('delete-product',function($user){
            return $user->checkPermissionAccess('delete_product');
        });


        Gate::define('list-slider',function($user){
            return $user->checkPermissionAccess('list_slider');
        });
        Gate::define('add-slider',function($user){
            return $user->checkPermissionAccess('add_slider');
        });
        Gate::define('edit-slider',function($user){
            return $user->checkPermissionAccess('edit_slider');
        });
        Gate::define('delete-slider',function($user){
            return $user->checkPermissionAccess('delete_slider');
        });


        Gate::define('list-user',function($user){
            return $user->checkPermissionAccess('list_user');
        });
        Gate::define('add-user',function($user){
            return $user->checkPermissionAccess('add_user');
        });
        Gate::define('edit-user',function($user){
            return $user->checkPermissionAccess('edit_user');
        });
        Gate::define('delete-user',function($user){
            return $user->checkPermissionAccess('delete_user');
        });


        Gate::define('list-role',function($user){
            return $user->checkPermissionAccess('list_role');
        });
        Gate::define('add-role',function($user){
            return $user->checkPermissionAccess('add_role');
        });
        Gate::define('edit-role',function($user){
            return $user->checkPermissionAccess('edit_role');
        });
        Gate::define('delete-role',function($user){
            return $user->checkPermissionAccess('delete_role');
        });


        Gate::define('list-order',function($user){
            return $user->checkPermissionAccess('list_order');
        });
        Gate::define('edit-order',function($user){
            return $user->checkPermissionAccess('edit_order');
        });
        Gate::define('delete-order',function($user){
            return $user->checkPermissionAccess('delete_order');
        });


        Gate::define('list-coupon',function($user){
            return $user->checkPermissionAccess('list_coupon');
        });
        Gate::define('add-coupon',function($user){
            return $user->checkPermissionAccess('add_coupon');
        });
        Gate::define('delete-coupon',function($user){
            return $user->checkPermissionAccess('delete_coupon');
        });


        Gate::define('list-feeship',function($user){
            return $user->checkPermissionAccess('list_feeship');
        });
        Gate::define('add-feeship',function($user){
            return $user->checkPermissionAccess('add_feeship');
        });

       
    }
}
