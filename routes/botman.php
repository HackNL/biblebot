<?php

use App\ApiHandler;
use App\BibleVerses;
use App\BookMapper;
use App\Http\Controllers\BotManController;
use App\InputHandler;


$botman = resolve( 'botman' );

$botman->fallback( function ( $bot ) {
$bot->reply( "Er is iets mis gegaan, probeer het later nog eens." );
} );
$botman->hears( '{input}', function ( $bot, $input ) {
	try {
		if($bot->userStorage()->get('botKey') == null){
			$bot->userStorage()->save(['botKey' => getGUID()]);
		}
		$inputHandler = new InputHandler();
		$parsedInput  = $inputHandler->parseInput($input,$bot->userStorage()->get('botKey'));

		//If parsedinput is intenthandler, handle specific requirest, otherwise reply next message
		if ( is_string( $parsedInput ) ) {
			if($parsedInput == "Restart")
			{
				$bot->userStorage()->delete();
			}
			else{
				$bot->reply($parsedInput);
			}
		}
		elseif(get_parent_class($parsedInput) == 'App\IntentHandlers\baseIntentHandler') {
			$handler = $parsedInput;
			$results = (array)$handler->handle();
			foreach($results as $result){
				$bot->reply(html_entity_decode($result));
			}
			$bot->userStorage()->delete();
		}
		else {
			$bot->reply('Something went wrong, parsedinput is empty or has no handler..');
		}
	}
	catch ( Exception $e ) {
		$bot->reply( $e->getMessage() . $e->getLine() );
		$bot->userStorage()->delete();
	}
} );
$botman->hears( 'Start conversation', BotManController::class . '@startConversation' );

function getGUID(){
	if (function_exists('com_create_guid')){
		return com_create_guid();
	}
	else {
		mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
		$charid = strtoupper(md5(uniqid(rand(), true)));
		$hyphen = chr(45);// "-"
		$uuid = substr($charid, 0, 8).$hyphen
		        .substr($charid, 8, 4).$hyphen
		        .substr($charid,12, 4).$hyphen
		        .substr($charid,16, 4).$hyphen
		        .substr($charid,20,12);
		return $uuid;
	}
}