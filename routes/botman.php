<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->fallback(function($bot) {
    $bot->reply('Wat bedoel je? Vraag mij bijvoorbeeld \'wat staat er in Johannes 3:16\'');
});

$botman->hears('([.*])', function ($bot, $passage) {
    $bot->reply('Gevonden gedeelte in de input: ' . $passage);
});


//wat staat er in Johannes 3:16
$botman->hears('Wat staat er in {gedeelte}', function ($bot, $gedeelteString) {
    //Gedeelte parsen naar API values
    $chapter = '';
    $verse = '';
    list($bookName, $gedeelte) = explode(' ', $gedeelteString, 2);
    list($chapter, $verse) = explode(':', $gedeelte);
    $bookName = strtolower($bookName);
    try{
    	$jsonString = file_get_contents('../data/book-mappings.json');
    	$bookMappings = json_decode($jsonString);
    	foreach($bookMappings as $bookMapping){
    		// $bot->reply(print_r($bookMapping, true));
    		if(strtolower($bookMapping->name) == $bookName || in_array($bookName, $bookMapping->alternatives)){
    			// $bot->reply('Mapping gevonden: ' . print_r($bookMapping, true));
    			$apiResponse = file_get_contents('https://bijbel.eo.nl/api/' . $bookMapping->apiName . '/' . $chapter . '/' . $verse);
    			$apiResponse = str_replace(array('/**/callback(', ');'), '', $apiResponse);
    			$resultObject = json_decode($apiResponse);
    			$responseString = $resultObject[0]->_source->flat_content;
    		}
    	}
    }
    catch(Exception $e){
    	$bot->reply('Oops, something went wrong: ' . $e->getMessage());
    }

    //API call doen
    

    //API response parsen
    if(isset($responseString)){
    	$bot->reply('In ' . $bookName . ' ' . $chapter . ' vers ' . $verse . ' staat \'' . $responseString . '\'');
	}
	else {
    	// $bot->reply('Het gevraagd gedeelte is ' . $gedeelteString . '. Boek: ' . $bookName . ', gedeelte: ' . $gedeelte);
    	$bot->reply('Sorry, hier kon ik niets mee');
    }

});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
