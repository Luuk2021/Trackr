<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;

class SuperAdminTest extends DuskTestCase
{
    public function testSuperAdminCanLogin(): void
    {
        $this->artisan('db:wipe');
        $this->artisan('migrate');
        $this->artisan('db:seed');

        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'superadmin@trackr.com')
                ->type('password', 'trackr')
                ->press('@login-button')
                ->assertPresent('@dashboard');
        });
    }

    public function testSuperAdminCanAddUser(): void
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                ->visit('/user')
                ->click('#add-user')
                ->type('@name', 'dusktestuser')
                ->type('@email', 'dusktestuser@trackr.com')
                ->type('@password', 'trackr')
                ->select('@select-shop', '1')
                ->type('@role', 'admin')
                ->pause(1000)
                ->press('@save')
                ->waitForLocation('/user')
                ->assertSee('dusktestuser@trackr.com');
        });
    }

    public function testSuperAdminCanEditUser(): void
    {
        $this->browse(function ($browser) {

            $browser->loginAs(User::find(1))
                ->visit('/user')
                ->with('#table', function ($table) {
                    $table->assertSee('dusktestuser@trackr.com')
                        ->click('#edit');
                });

            $browser->pause(1000)
                ->assertSee('Save')
                ->type('@name', 'dusktestuser123')
                ->pause(1000)
                ->press('@save')
                ->waitForLocation('/user')
                ->assertSee('dusktestuser123');
        });
    }

    public function testSuperAdminCanDeleteUser(): void
    {
        $this->browse(function ($browser) {

            $browser->loginAs(User::find(1))
                ->visit('/user')
                ->with('#table', function ($table) {
                    $table->assertSee('dusktestuser@trackr.com')
                        ->click('#delete');
                });

            $browser->acceptDialog();

            $browser->waitForLocation('/user')
                ->pause(1000)
                ->assertDontSee('dusktestuser@trackr.com');
        });
    }

    public function testSuperAdminCanAddShop(): void
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                ->visit('/shop')
                ->click('#add-shop')
                ->type('@name', 'dusktestshop')
                ->type('@streetname', 'testsstreet')
                ->pause(1000)
                ->type('@housenumber', '7')
                ->pause(1000)
                ->type('@zipcode', '1234AB')
                ->pause(1000)
                ->type('@city', 'testcity')
                ->press('@save')
                ->waitForLocation('/shop')
                ->pause(100)
                ->assertSee('dusktestshop');
        });
    }

    public function testSuperAdminCanEditShop(): void
    {
        $this->browse(function ($browser) {

            $browser->loginAs(User::find(1))
                ->visit('/shop')
                ->with('#table', function ($table) {
                    $table->assertSee('dusktestshop')
                        ->click('#edit');
                });

            $browser->pause(1000)
                ->assertSee('Save')
                ->type('@name', 'dusktestshop123')
                ->pause(1000)
                ->press('@save')
                ->waitForLocation('/shop')
                ->assertSee('dusktestshop123');
        });
    }

    public function testSuperAdminCanDeleteShop(): void
    {
        $this->browse(function ($browser) {

            $browser->loginAs(User::find(1))
                ->visit('/shop')
                ->with('#table', function ($table) {
                    $table->assertSee('dusktestshop123')
                        ->click('#delete');
                });

            $browser->acceptDialog();

            $browser->waitForLocation('/shop')
                ->pause(1000)
                ->assertDontSee('dusktestshop123');
        });
    }
}
