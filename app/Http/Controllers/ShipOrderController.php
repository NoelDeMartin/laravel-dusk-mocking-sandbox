<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShipOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $orderId = intval($request->input('order_id'));

        Mail::to('shipments@example.org')->send(new OrderShipped($orderId));

        return "Order #$orderId has been shipped!";
    }
}
