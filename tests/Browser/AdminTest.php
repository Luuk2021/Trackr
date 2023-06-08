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
                ->assertDontSee('testsstreet')
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
                ->assertSee('testsstreet');

            $browser->visit('/userAdmin')
                ->assertSee('luuk@trackr.com');
        });
    }

    public function testAdminCanAddBulk(): void
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(2))
                ->visit('/package')
                ->attach('#file', '.\tests\TestingFiles\trackrtest.csv')
                ->pause('2000')
                ->click('@import')
                ->pause('2000')
                ->assertSee('joop@gmail.com')
                ->assertSee('kaas@kaas.com')
                ->assertSee('nietfokke_69@hotmail.com')
                ->assertSee('kaaswastaken@kaas.com')
                ->assertSee('keesmail@student.avans.nl')
                ->assertSee('klant@klant.com');
        });
    }

    public function testAdminCanDeletePackage(): void
    {
        $this->browse(function ($browser) {

            $browser->loginAs(User::find(2))
                ->visit('/package')
                ->with('#table', function ($table) {
                    $table->assertSee('joost@hotmail.com')
                        ->click('#delete');
                });

            $browser->acceptDialog()
                ->waitForLocation('/package')
                ->pause(2000)
                ->assertDontSee('joost@hotmail.com');
        });
    }

    public function testAdminCanDownload(): void
    {
        $this->browse(function ($browser) {

            $browser->loginAs(User::find(2))
                ->visit('/package')
                ->with('#table', function ($table) {
                    $table->assertSee('luuk@trackr.com')
                        ->click('#download');
                });
        });
    }

    public function testAdminCanDownloadBulk(): void
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(2))
                ->visit('/package')
                ->check('#checkbox3')
                ->pause(1000)
                ->check('#checkbox4')
                ->pause(1000)
                ->check('#checkbox5')
                ->pause(1000)
                ->assertChecked('#checkbox3')
                ->assertChecked('#checkbox4')
                ->assertChecked('#checkbox5')
                ->click('#download-bulk')
                ->pause(2000);
        });
    }
}
