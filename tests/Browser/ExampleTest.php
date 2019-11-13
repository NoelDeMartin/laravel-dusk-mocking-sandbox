<?php

namespace Tests\Browser;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Tests\DuskTestCase;
use NoelDeMartin\LaravelDusk\Browser;

class ExampleTest extends DuskTestCase
{
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    public function testEmailMocking()
    {
        $this->browse(function (Browser $browser) {
            $mail = $browser->fake(Mail::class);

            $browser->visit('/ship-order?order_id=42')
                    ->assertSee('Order #42 has been shipped!');

            $mail->assertSent(OrderShipped::class, function ($mail) {
                return $mail->orderId === 42;
            });
        });
    }
}
