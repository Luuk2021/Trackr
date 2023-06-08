<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;

class AdminTest extends DuskTestCase
{
    public function testAdminCanLogin(): void
    {
        $this->artisan('db:wipe');
        $this->artisan('migrate');
        $this->artisan('db:seed');

        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'bol.admin@trackr.com')
                ->type('password', 'trackr')
                ->press('@login-button')
                ->assertPresent('@dashboard');
        });
    }

    public function testAdminCanAddPackage(): void
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(2))
                ->visit('/package')
                ->assertDontSee('luuk@trackr.com')
                ->click('#add-package')
                ->type('@email', 'luuk@trackr.com')
                ->type('@firstname', 'luuk')
                ->type('@lastname', 'geurten')
                ->type('@streetname', 'testsstreet')
                ->pause(1000)
                ->type('@housenumber', '18')
                ->pause(1000)
                ->type('@zipcode', '1234AB')
                ->pause(1000)
                ->type('@city', 'testcity')
                ->select('@select-shop', '1')
                ->pause(1000)
                ->press('@save')
                ->waitForLocation('/package')
                ->assertSee('luuk@trackr.com');

            $browser->visit('/userAdmin')
                ->assertSee('luuk@trackr.com');
        });
    }

    public function testAdminCanAddBulk(): void
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(2))
                ->visit('/package')
                ->assertDontSee('luuk@trackr.com')
                ->attach('#file', 'C:\Users\Luuk\Desktop\trackrman.csv')
                ->screenshot('1');
        });
    }
}
