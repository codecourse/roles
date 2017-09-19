<?php

use Codecourse\Roles\Models\Role;

class RolesTest extends TestCase
{
    /** @test */
    public function timestamps_are_disabled()
    {
        $role = new Role;

        $this->assertFalse($role->timestamps);
    }
}
