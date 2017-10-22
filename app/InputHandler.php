<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 10/21/2017
 * Time: 10:46 AM
 */

namespace App;


class InputHandler {
	const INPUT_TYPE_SEARCH = 'Search'; //Zoeken naar bepaalde term door hele bijbel
	const INPUT_TYPE_VERSES = 'Verses'; //Bijbelgedeelte opvraag
	const INPUT_TYPE_RANDOM = 'Random'; //Willekeruige tekst
	const INPUT_TYPE_HELP = 'Help';
	const INPUT_TYPE_RESTART = 'Restart';

	private $parsedBookName;
	private $parsedChapter;
	private $parsedBeginVerse;
	private $parsedEndVerse;
	private $apiName;

	public function __construct() {
	}

	public function parseInput( $rawInput,$botKey ) {
		$curl = curl_init();
		curl_setopt_array( $curl, array(
			CURLOPT_URL            => "https://api.dialogflow.com/v1/query?v=20170712&query=" . urlencode( $rawInput ) . "&lang=en&sessionId=" . $botKey . "&timezone=Europe%2FParis'",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "GET",
			CURLOPT_HTTPHEADER     => array(
				"authorization: Bearer be3b238fa0f64f59b214990a2168ee4a",
				"cache-control: no-cache",
				"postman-token: 334a5136-62b6-d743-956f-62dc271530de"
			),
		) );
		$response = curl_exec( $curl );
		$err      = curl_error( $curl );
		curl_close( $curl );
		$result = json_decode( $response );

		if($result->result->metadata->intentName == self::INPUT_TYPE_RESTART){
			return "Restart";
		}

		if($result->result->fulfillment->speech != ""){
			return $result->result->fulfillment->speech;
		}
		elseif(isset($result->result->metadata->intentName)){
			//Intent is known and no further responise is set, so handle the intent
			$intentName = $result->result->metadata->intentName;
			$parameters = isset($result->result->parameters) ? (array)$result->result->parameters : [];
			switch($intentName){
				case self::INPUT_TYPE_VERSES:
					$handler = new \App\IntentHandlers\versesIntentHandler($intentName, $parameters);
				break;

                case self::INPUT_TYPE_SEARCH:

                    $handler = new \App\IntentHandlers\searchIntentHandler($intentName, $parameters);
//                    $handler = "SearchIntent.";
				break;

				case self::INPUT_TYPE_RANDOM:
                    $handler = new \App\IntentHandlers\randomIntentHandler($intentName, $parameters);
				break;
				
				case self::INPUT_TYPE_HELP:

				break;
				default:

				break;
			}

			if(isset($handler)) return $handler;
		}
		return false;
	}

	/**
	 * @return mixed
	 */
	public function getParsedBookName() {
		return $this->parsedBookName;
	}

	/**
	 * @return mixed
	 */
	public function getParsedChapter() {
		return $this->parsedChapter;
	}

	/**
	 * @return mixed
	 */
	public function getParsedBeginVerse() {
		return $this->parsedBeginVerse;
	}

	/**
	 * @return mixed
	 */
	public function getParsedEndVerse() {
		return $this->parsedEndVerse;
	}

	public function getApiName() {
		$jsonString   = file_get_contents( '../data/book-mappings.json' );
		$bookMappings = json_decode( $jsonString );
		foreach ( $bookMappings as $bookMapping ) {
			// $bot->reply(print_r($bookMapping, true));
			if ( strtolower( $bookMapping->name ) == $this->parsedBookName || in_array( $this->parsedBookName, $bookMapping->alternatives ) ) {
				$this->apiName = $bookMapping->apiName;
				return $this->apiName;
			}
		}
	}
}