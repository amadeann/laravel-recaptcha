<?php

namespace Amadeann\Recaptcha\Rules;

use Amadeann\Recaptcha\Facades\Recaptcha;
use Illuminate\Contracts\Validation\Rule;

class RecaptchaV2 implements Rule
{
    protected $container;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($container = null)
    {
        $this->container = $container ?? config('recaptcha.default');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Recaptcha::container($this->container)->verify($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Recaptcha validation failed.';
    }
}
