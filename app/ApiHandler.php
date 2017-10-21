<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 10/21/2017
 * Time: 10:31 AM
 */

namespace App;


class ApiHandler {

	Public Function __construct() {
	}

	Public function ApiHandler() {
		return new ApiHandler();
	}

	Public function sendApiCall($apiName,$chapter,$beginVerse,$endVerse){

		//Make API Call
		$apiResponse = file_get_contents('https://bijbel.eo.nl/api/' . $apiName . '/' . $chapter . '/' . $beginVerse);
		//Remove callback from JSON
		$apiResponse = str_replace(array('/**/callback(', ');'), '', $apiResponse);
		//Decode JSON
		$resultObject = json_decode($apiResponse);
		//Parse data
		return $resultObject[0]->_source->flat_content;
	}
}