<?php

namespace Amadeann\Recaptcha;

use Illuminate\Support\Facades\Http;

class Recaptcha
{
    protected $container;

    public function __construct()
    {
        $this->container = config('recaptcha.default');
    }

    public function container($container)
    {
        $this->container = $container;

        return $this;
    }

    public function verify($token)
    {
        return Http::asForm()->post(config('recaptcha.site_verify_url'), [
            'secret' => config('recaptcha.containers.' . $this->container . ".secret_key"),
            'response' => $token,
        ])['success'];
    }
}
