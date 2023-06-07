<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     */

    public function testExample(): void
    {
        /**
         * A basic browser test example.
         *
         * @return void
         */
        {
            $this->browse(function ($browser) {
                $browser->visit('/login')
                    ->type('email', 'superadmin@trackr.com')
                    ->type('password', 'trackr')
                    ->press('@login-button')
                    ->assertPresent('@dashboard');
            });
        }
    }
}
