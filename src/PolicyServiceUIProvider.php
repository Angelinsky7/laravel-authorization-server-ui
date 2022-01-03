<?php

namespace Darkink\AuthorizationServerUI;

use Darkink\AuthorizationServer\View\Components\ButtonCancel;
use Darkink\AuthorizationServer\View\Components\ButtonDot;
use Darkink\AuthorizationServer\View\Components\IconBoolTick;
use Darkink\AuthorizationServer\View\Components\ButtonRaised;
use Darkink\AuthorizationServer\View\Components\ButtonStroked;
use Darkink\AuthorizationServer\View\Components\ButtonSubmit;
use Darkink\AuthorizationServer\View\Components\Dropdown;
use Darkink\AuthorizationServer\View\Components\DropdownLink;
use Darkink\AuthorizationServer\View\Components\FormFieldError;
use Darkink\AuthorizationServer\View\Components\Table;
use Illuminate\Support\ServiceProvider;

class PolicyServiceUIProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'policy-ui');

        $this->loadViewComponentsAs('policy-ui', [
            IconBoolTick::class,
            ButtonRaised::class,
            ButtonStroked::class,
            ButtonDot::class,
            ButtonCancel::class,
            ButtonSubmit::class,
            Table::class,
            FormFieldError::class,
            Dropdown::class,
            DropdownLink::class
        ]);

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/policy-ui'),
            ], 'policy-ui-views');

            $this->publishes([
                __DIR__.'/../public/css/app.css' => base_path('resources/css/vendor/laravel-authorization-server.css'),
            ], 'policy-ui-public-css');

            $this->publishes([
                __DIR__.'/../public/js/app.js' => base_path('resources/js/vendor/laravel-authorization-server.js'),
            ], 'policy-ui-public-js');

        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/policy-ui.php', 'policy-ui');
    }

}
