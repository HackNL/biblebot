<?php
namespace App\IntentHandlers;

use App\BookMapper;
use App\ApiHandler;

class versesIntentHandler extends baseIntentHandler {

	/** API call to EO */
	public function handle(){
		$apiHandler = new ApiHandler();
		return $apiHandler->sendApiCall( BookMapper::getApiNameByName($this->parameters["Book"]), $this->parameters["Chapter"], $this->parameters["Verse"], $this->parameters['VerseEnd'] );
	}
}