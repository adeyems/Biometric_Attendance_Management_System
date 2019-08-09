<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    /**
     * @param Request $request
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public static function sendSMS(Request $request )
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );


        $client->messages->create(
            '+2348100571955',
            [
                'from' => 'CL school',
                'body' => "Remi's Project - From Christ Life School. Your ward left the school bus at 4:15p.m. This is a test. Holla if you get this.",
            ]
        );
    }
}
