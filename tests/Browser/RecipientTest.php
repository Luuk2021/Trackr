<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;

class RecipientTest extends DuskTestCase
{
    public function testRecipientCanLogin(): void
    {
        $this->artisan('db:wipe');
        $this->artisan('migrate');
        $this->artisan('db:seed');

        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'luuk@trackr.com')
                ->type('password', 'trackr')
                ->press('@login-button')
                ->assertPresent('@dashboard');
        });
    }

    public function testRecipientCanTrace(): void
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(4))
                ->visit('/packageRecipient')
                ->assertDontSee('luuk@trackr.com')
                ->visit('/trace')
                ->type('#code', '2b7b2527-b372-46aa-a79f-a61d0b5889a8')
                ->click('#search')
                ->assertSee('Search Result')
                ->visit('/packageRecipient')
                ->assertSee('luuk@trackr.com');
        });
    }
}
