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
		$inputHandler = new InputHandler();
		$parsedInput  = $inputHandler->parseInput( $input );
		
		//If parsedinput is intenthandler, handle specific requirest, otherwise reply next message
		if ( is_string( $parsedInput ) ) {
			$bot->reply( $parsedInput );
		} 
		elseif(get_parent_class($parsedInput) == 'App\IntentHandlers\baseIntentHandler') {
			$handler = $parsedInput;
			$results = (array)$handler->handle();
			foreach($results as $result){
				$bot->reply($result);	
			}
		}
		else {
			$bot->reply('Something went wrong, parsedinput is empty or has no handler..');
		}
	}
	catch ( Exception $e ) {
		$bot->reply( $e->getMessage() . $e->getLine() );
	}
} );
$botman->hears( 'Start conversation', BotManController::class . '@startConversation' );