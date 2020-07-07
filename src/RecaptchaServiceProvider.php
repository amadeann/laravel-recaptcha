<?php

namespace Amadeann\Recaptcha;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider
{
    protected $configPath = __DIR__ . '/../config/recaptcha.php';

    public function register()
    {
        $this->mergeConfigFrom($this->configPath, 'recaptcha');

        $this->app->bind('recaptcha', function () {
            return new Recaptcha;
        });
    }

    public function boot()
    {
        $this->publishes([
            $this->configPath => config_path('recaptcha.php'),
        ]);
    }

    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $defaultConfig = require $path;

        $this->app['config']->set($key, $this->array_merge_recursive_distinct($defaultConfig, $config));
    }

    protected function array_merge_recursive_distinct(array &$array1, array &$array2)
    {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = $this->array_merge_recursive_distinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}
