<?php

namespace Darkink\AuthorizationServerUI;

use Darkink\AuthorizationServerUI\View\Components\ButtonCancel;
use Darkink\AuthorizationServerUI\View\Components\ButtonDot;
use Darkink\AuthorizationServerUI\View\Components\IconBoolTick;
use Darkink\AuthorizationServerUI\View\Components\ButtonRaised;
use Darkink\AuthorizationServerUI\View\Components\ButtonStroked;
use Darkink\AuthorizationServerUI\View\Components\ButtonSubmit;
use Darkink\AuthorizationServerUI\View\Components\Dropdown;
use Darkink\AuthorizationServerUI\View\Components\DropdownLink;
use Darkink\AuthorizationServerUI\View\Components\FormFieldError;
use Darkink\AuthorizationServerUI\View\Components\SuccessMessage;
use Darkink\AuthorizationServerUI\View\Components\Table;
use Darkink\AuthorizationServerUI\View\Components\TableSortHeader;
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

        $this->loadViewComponentsAs('policy-ui', require(__DIR__ . '/View/Components/components.php'));

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
