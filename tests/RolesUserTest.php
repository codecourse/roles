<?php

use Codecourse\Roles\Models\Role;
use Illuminate\Support\Collection;

class RolesUserTest extends TestCase
{
    /** @test */
    public function a_user_can_have_a_role()
    {
        $user = User::create([
            'email' => 'alex@codecourse.com'
        ]);

        $role = Role::create(['title' => 'admin']);

        $user->roles()->save($role);

        $this->assertInstanceOf(Role::class, $user->roles->first());
    }

    /** @test */
    public function a_user_can_have_many_roles()
    {
        $user = User::create([
            'email' => 'alex@codecourse.com'
        ]);

        $adminRole = Role::create(['title' => 'admin']);
        $moderatorRole = Role::create(['title' => 'moderator']);

        $user->roles()->saveMany([$adminRole, $moderatorRole]);

        $this->assertInstanceOf(Collection::class, $user->roles);
        $this->assertCount(2, $user->roles);
    }

    /** @test */
    public function checks_to_see_if_a_user_has_a_role()
    {
        $user = User::create([
            'email' => 'alex@codecourse.com'
        ]);

        $role = Role::create(['title' => 'admin']);

        $user->roles()->save($role);

        $this->assertTrue($user->hasRole('admin'));
    }

    /** @test */
    public function checks_to_see_if_a_user_has_a_role_and_fails()
    {
        $user = User::create([
            'email' => 'alex@codecourse.com'
        ]);

        $this->assertFalse($user->hasRole('admin'));
    }
}
