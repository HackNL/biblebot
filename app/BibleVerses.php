<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 10/21/2017
 * Time: 1:13 AM
 */

namespace App;

class BibleVerses {
	private $beginVerse;
	private $endVerse;
	private $chapter;
	private $bookName;
	private $verseText;
	private $apiName;


	Public Function __construct($beginVerse,$endVerse,$bookName,$chapter,$apiName)
	{
		$this->beginVerse = $beginVerse;
		$this->endVerse = $endVerse;
		$this->bookName = $bookName;
		$this->chapter = $chapter;
		$this->apiName = $apiName;
	}

	/**
	 * Method to get the verse text through an get call
	 */
	public function setVerseText($verseText){
		$this->verseText = $verseText;

	}

	/**
	 * @return mixed
	 */
	public function getBeginVerse(){
		return $this->beginVerse;
	}

	/**
	 * @return mixed
	 */
	public function getChapter(){
		return $this->chapter;
	}

	/**
	 * @return mixed
	 */
	public function getEndVerse(){
		return $this->endVerse;
	}

	/**
	 * @return mixed
	 */
	public function getVerseText(){
		return $this->verseText;
	}

	/**
	 * @return mixed
	 */
	public function getBookName(){
		return $this->bookName;
	}
	/**
	 * @return mixed
	 */
	public function getApiName(){
		return $this->apiName;
	}
}