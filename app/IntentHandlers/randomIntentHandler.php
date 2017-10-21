<?php

namespace App\IntentHandlers;

use App\ApiHandler;

class randomIntentHandler extends baseIntentHandler
{
    /** API call to One Signal */
    public function handle()
    {
        $apiHandler = new ApiHandler();
        $json = $apiHandler->getVerseOfTheDay();
        $result = json_decode($json);
        return array($result->header, $result->content);
    }
}