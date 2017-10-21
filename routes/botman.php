<?php

use App\ApiHandler;
use App\BibleVerses;
use App\Http\Controllers\BotManController;
use App\InputHandler;

$botman = resolve( 'botman' );

$botman->fallback( function ( $bot ) {
	$bot->reply( 'Wat bedoel je? Vraag mij bijvoorbeeld \'Wat staat er in Johannes 3:16\'' );
} );

$botman->hears( '([.*])', function ( $bot, $passage ) {
	$bot->reply( 'Gevonden gedeelte in de input: ' . $passage );
} );

$botman->hears( 'Wat staat er in {gedeelte}', function ( $bot, $input ) {
	try {
		$inputHandler = new InputHandler( $input );
		$apiHandler   = new ApiHandler();
        $bibleVerse = new BibleVerses($inputHandler->getParsedBeginVerse(), "", $inputHandler->getParsedBookName(), $inputHandler->getParsedChapter(), $inputHandler->getApiName());
        $bibleVerse->setVerseText($apiHandler->sendApiCall( $bibleVerse->getApiName(), $bibleVerse->getChapter(), $bibleVerse->getBeginVerse(), "" ) );
		$bot->reply( $bibleVerse->getVerseText() );
	}
	catch(Exception $e){
		$bot->reply('fout! ' . $e->getMessage());
	}
});
$botman->hears( 'Start conversation', BotManController::class . '@startConversation' );
