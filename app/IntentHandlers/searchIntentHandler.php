<?php
namespace App\IntentHandlers;

use App\BookMapper;
use App\ApiHandler;

class searchIntentHandler extends baseIntentHandler {
	/** API call to EO */
	public function handle(){
        $apiHandler = new ApiHandler();
        $result = $apiHandler->searchApiCall('search' , $this->parameters["SearchTerm"]);
		return $result;
	}
}