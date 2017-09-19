<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class Role implements Rule
{
    /**
     * The role to check for,
     *
     * @var string
     */
    protected $role;

    /**
     * Create the role.
     *
     * @param string $role
     */
    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where($attribute, $value)->first();

        if (!$user) {
            return false;
        }

        return $user->hasRole($this->role);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The \'' . $this->role . '\' role is required.';
    }
}
