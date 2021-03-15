<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_see_login_link()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSeeLink('LOGIN');
        });
    }

    public function test_user_can_log_in()
    {
      User::create([
        'name' => 'Test User',
        'email' => 'test123@test.com',
        'password' => bcrypt('password')
      ]);

      $this->browse(function (Browser $browser) {
          $browser->visit('/')
                  ->clickLink('Login')
                  ->type('email', 'test123@test.com')
                  ->type('password', 'password')
                  ->press('Login')
                  ->assertPathIs('/home');
      });
    }
}
