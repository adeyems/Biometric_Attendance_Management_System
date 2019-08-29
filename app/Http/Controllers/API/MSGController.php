<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SMSController;
use Illuminate\Http\Request;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class MSGController extends Controller
{
    /**
     * @param Request $request
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function sendSMS(Request $request)
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );



        $client->messages->create(
            $request->to,
            [
                'from' => 'CheckHealth',
                'body' => $request->body,
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function send(Request $request)
    {

        try {
            $this->sendSMS($request);
        } catch (ConfigurationException $e) {
            return response()->json(["response" => $e->getMessage()], 400);
        } catch (TwilioException $e) {
            return response()->json(["response" => $e->getMessage()], 500);
        }
        return response()->json(["response" => true], 200);
    }
}
