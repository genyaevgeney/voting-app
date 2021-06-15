<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckUserBalance implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $percent = config('ideas.percent');

        return (auth()->user()->balance >= ($value * ($percent / 100)));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "You don't have enough funds in account.";
    }
}
