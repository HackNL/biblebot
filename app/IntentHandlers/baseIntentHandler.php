<?php
namespace App\IntentHandlers;

abstract class baseIntentHandler {

	public $intentName;

	public $parameters;

	public function __construct($intentName, array $parameters){
		$this->intentName = $intentName;
		$this->parameters = $parameters;
	}

	/** Default handler, not implemented message */
	public function handle(){
		return 'Not implemented..';
	}
}