<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 10/21/2017
 * Time: 10:46 AM
 */

namespace App;


class InputHandler {
	const INPUT_TYPE_SEARCH = 1; //Zoeken naar bepaalde term door hele bijbel
	const INPUT_TYPE_LOOKUP = 2; //Bijbelgedeelte opvraag
	const INPUT_TYPE_SEARCH_AMOUNT = 3; //Aantal hit van bepaalde zoekterm door hele bijbel

	private $rawInput;
	private $inputType; //1 van de drie constantes
	private $parsedBookName;
	private $parsedChapter;
	private $parsedBeginVerse;
	private $parsedEndVerse;
	private $apiName;

	public function __construct( $rawInput ) {
		$this->parseInput( $rawInput );
	}

	public function parseInput( $rawInput ) {
		list( $bookName, $bookPart ) = explode( ' ', $rawInput );
		list( $this->parsedChapter, $this->parsedBeginVerse ) = explode( ':' , $bookPart );
		$this->parsedBookName = strtolower( $bookName );
		$this->setApiName();
//		if($rawInput == 'wat staat er in ...'){
//			$this->inputType = self::INPUT_TYPE_LOOKUP;
//		}elseif($rawInput == 'zoek naar ...'){
//			$this->inputType = self::INPUT_TYPE_SEARCH;
//		}
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

	/**
	 * @return mixed
	 */
	public function getApiName() {
		return $this->apiName;
	}

	public function setApiName() {
		$jsonString   = file_get_contents( '../data/book-mappings.json' );
		$bookMappings = json_decode( $jsonString );
		foreach ( $bookMappings as $bookMapping ) {
			// $bot->reply(print_r($bookMapping, true));
			if ( strtolower( $bookMapping->name ) == $this->parsedBookName || in_array( $this->parsedBookName, $bookMapping->alternatives )) {
				$this->apiName = $bookMapping->apiName;
				break;
			}
		}
	}
}