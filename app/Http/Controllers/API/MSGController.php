<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class MSGController extends Controller
{
    /**
     * @param Request $request
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public static function send(Request $request)
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );



        $client->messages->create(
            $request->to,
            [
                'from' => 'CheckHealth',
                'body' => "Dear Esugbemi Esulogaju, Abnormal readings have been detected. Please make appointment as soon as possible to visit me.",
            ]
        );
    }
}
