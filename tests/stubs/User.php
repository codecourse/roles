<?php

use Codecourse\Roles\HasRoles;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    use HasRoles;

    /**
     * The database connection.
     *
     * @var string
     */
    protected $connection = 'testbench';

    /**
     * The database table.
     *
     * @var string
     */
    public $table = 'users';
}