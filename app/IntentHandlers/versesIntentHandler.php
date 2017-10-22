<?php

namespace App\IntentHandlers;

use App\BookMapper;
use App\ApiHandler;

class versesIntentHandler extends baseIntentHandler
{

    /** API call to EO */
    public function handle()
    {
        $apiHandler = new ApiHandler();
        $header = $this->parameters["Book"] . ' ';
        $header .= $this->parameters["Chapter"] . ' vers ';
        $header .= $this->parameters["Verse"] . ' ';
        if ($this->parameters['VerseEnd'])
        {
            $header .= 'tot ' . $this->parameters['VerseEnd'];
        };
        return [
            $header,
            $apiHandler->sendApiCall(
                BookMapper::getApiNameByName($this->parameters["Book"]),
                $this->parameters["Chapter"],
                $this->parameters["Verse"],
                $this->parameters['VerseEnd']
            )
        ];
    }
}