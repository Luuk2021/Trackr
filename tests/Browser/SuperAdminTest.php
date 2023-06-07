<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

class SuperAdminTest extends DuskTestCase
{
    public function testSuperAdminCanLogin(): void
    {
        $this->artisan('db:wipe');
        $this->artisan('migrate');
        $this->artisan('db:seed');

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'superadmin@trackr.com')
                ->type('password', 'trackr')
                ->press('@login-button')
                ->assertPresent('@dashboard');
        });
    }
}
