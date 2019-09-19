<?php

namespace App;

use Mailgun\Mailgun;

/**
 * Mail
 *
 * PHP version 7.0
 */
class Mail
{

    /**
     * Send a message
     *
     * @param string $to Recipient
     * @param string $subject Subject
     * @param string $text Text-only content of the message
     * @param string $html HTML content of the message
     *
     * @return mixed
     */

    public static function send($to, $subject, $text, $html, $attachments = null)
    {
        $mgClient = new Mailgun('2ee9e9ee6dac753a72390626f05bd56a-7bbbcb78-b394f22e');
        $domain = 'campusvender.com';

        //$html = file_get_contents($html);

        $result = $mgClient->sendMessage(
            $domain,
            array(
                'from'    =>
                    'Christ Light School <contact@christlight school.com>',
                'to'      =>
                    $to,
                'subject' =>
                    $subject,
                'text'    =>
                    $text,
                'html'    => $html
            ),
            array(
                'attachment' =>
                    $attachments
            )
        );

    }

    public static function sendMail($from, $to, $subject, $text, $html)
    {
        //Instantiate the client.
        $mgClient = new Mailgun(Config::MAILGUN_API_KEY);
        $domain = 'campusvender.com';

        # Make the call to the client.
        $result = $mgClient->sendMessage($domain, [
            'from' => 'Christ Light School',
            'to' => $to,
            'subject' => $subject,
            'text' => $text,
            'html' => $html]);

        return $result;
    }
}
/*$mg = new Mailgun(Config::MAILGUN_API_KEY);
        $domain = Config::MAILGUN_DOMAIN;

        $mg->sendMessage($domain, ['from' => 'your-sender@your-domain.com',
            'to' => $to,
            'subject' => $subject,
            'text' => $text,
            'html' => $html]);*/
