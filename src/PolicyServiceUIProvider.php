<?php

namespace Darkink\AuthorizationServerUI;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;

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
        $this->loadDirectives('policy_ui', require(__DIR__ . '/View/Directives/directives.php'));

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/policy-ui'),
            ], 'policy-ui-views');

            $this->publishes([
                __DIR__ . '/../public/css/app.css' => base_path('resources/css/vendor/laravel-authorization-ui-server.css'),
            ], 'policy-ui-public-css');

            $this->publishes([
                __DIR__ . '/../public/js/app.js' => base_path('resources/js/vendor/laravel-authorization-ui-server.js'),
            ], 'policy-ui-public-js');
        }

        $this->register_helpers();
    }

    protected function loadDirectives(string $prefix, array $directives)
    {
        foreach ($directives as $directive) {
            $directive_key = Str::snake($prefix) . '_' . Str::snake(class_basename($directive));
            $class = new ReflectionClass($directive);
            $staticmethods = $class->getMethod('execute');
            Blade::directive($directive_key, $staticmethods->getClosure());
        }
    }

    public function register_helpers()
    {
        if (file_exists($file = __DIR__ . '/bladeHelper.php')) {
            require_once $file;
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/policy-ui.php', 'policy-ui');
    }
}
