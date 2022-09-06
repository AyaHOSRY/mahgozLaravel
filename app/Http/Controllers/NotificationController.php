<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendSmsNotificaition()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('90326cf9', 'AT38wZdRJjPDuOZN');
        $client = new \Nexmo\Client($basic);
   /* $basic  = new \Vonage\Client\Credentials\Basic("90326cf9", "AT38wZdRJjPDuOZN");
    $client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));*/

    $message = $client->message()->send([
        'to' => '201011544461',
        'from' => 'laravel',
        'text' => 'verified code man'
    ]);

    dd('SMS message has been delivered.');

}
}
