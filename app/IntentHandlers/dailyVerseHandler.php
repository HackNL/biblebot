<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 10/22/2017
 * Time: 11:29 AM
 */

namespace App\IntentHandlers;

use App\BookMapper;
use App\ApiHandler;
class dailyVerseHandler extends baseIntentHandler {

	/** API call to One Signal */
	public function handle()
	{
		$apiHandler = new ApiHandler();
		return $apiHandler->getDailyVerse();
	}
}
