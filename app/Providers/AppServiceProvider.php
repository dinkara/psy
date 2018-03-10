<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(250);
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models = array('Certificate', 'Company', 'Doctor', 'Message', 'Note', 'PasswordReset', 'Patient', 'Profile', 'Question', 'Rating', 'RatingsQuestion', 'Role', 'Session', 'SocialNetwork', 'Transaction', 'User', 'UsersRole', 'UsersSocialNetwork', 'Wallet');
        /*  'User',
            'Role',
            'Profile',
            'PasswordReset',
            'SocialNetwork'*/
        
        foreach ($models as $idx => $model) {            
            $this->app->bind("App\Repositories\\{$model}\I{$model}Repo", "App\Repositories\\{$model}\\Eloquent{$model}");
        }
    }
}
