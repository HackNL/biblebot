<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 10/21/2017
 * Time: 10:31 AM
 */

namespace App;


class ApiHandler
{

    public function __construct()
    {
    }

    public function apiHandler()
    {
        return new ApiHandler();
    }

    public function sendApiCall($apiName, $chapter, $beginVerse, $endVerse)
    {
        //Make API Call
        $apiResponse = file_get_contents('https://bijbel.eo.nl/api/' . $apiName . '/' . $chapter . '/' . $beginVerse . '/' . $endVerse);
        //Remove callback from JSON
        $apiResponse = str_replace(array('/**/callback(', ');'), '', $apiResponse);
        //Decode JSON
        $resultObject = json_decode($apiResponse);
        //Parse data
	    $result = "";
	    for ($i = 0; $i < count($resultObject); $i++) {
		    $result = $result . $resultObject[$i]->_source->flat_content;
		    if (empty($endVerse)) {
		        break; // return only one verse
            } else {
		        $result .= ' ';
            }
	    }
        return $result;
    }

    public function searchApiCall($apiName, $searchterm)
    {
        //Make API Call
        $apiResponse = file_get_contents('https://bijbel.eo.nl/api/' . $apiName . '/' . str_replace('+' , '%20', urlencode($searchterm))) ;

        //Decode JSON
        $resultObject = json_decode($apiResponse);
        //return "Niks gevonden ?";
        foreach ($resultObject->hits->hits as $hit) {
            if ($hit->_type === 'verse') {
                return [
                    'Top! Ik heb ' . $resultObject->hits->total . ' resultaten gevonden. Hier heb je een vers waar "' . $searchterm .
                    '" in voorkomt: ',
                    $hit->_source->book_title . ' ' . $hit->_source->chapter . ':' . $hit->_source->number .' :' .$hit->_source->flat_content,
                    'Hier heb je een link om meer resultaten uit te pluizen: https://bijbel.eo.nl/zoeken?q=' . urlencode($searchterm)
                ];
            }
        }

        return [
            '"' . $searchterm .'" heb ik niet voor je kunnen vinden in de bijbel.'
        ];
    }

	public function getDailyVerse() {
		$curl = curl_init();
		curl_setopt_array( $curl, array(
			CURLOPT_URL            => "https://www.biblegateway.com/votd/get/?format=json&version=HTB",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "GET",
			CURLOPT_HTTPHEADER     => array(
				"cache-control: no-cache",
				"postman-token: a5768b49-c0fd-7406-0f92-1acdddf1adf9"
			),
		) );
		$response = curl_exec( $curl );
		curl_close( $curl );
		//Decode JSON
		$resultObject =  json_decode( $response );
		$dailyVerse = explode(" ",$resultObject->votd->reference);
		$bookName = $dailyVerse[0];
		$verses = explode(":", $dailyVerse[1]);
		$chapter = $verses[0];
		$verse = $verses[1];
		$apiName = BookMapper::getApiNameByEnglishName($bookName);
		$display_ref = $resultObject->votd->display_ref .  " ";
		return $display_ref . $this->sendApiCall($apiName,$chapter,$verse,$verse);
	}

	/*
	 * Get verse of the day from the OneSignal API
	 * TODO: Change to daily verse
	 */
    public function getVerseOfTheDay()
    {
        $limit = 1;
        $offset = 1287; // vanaf 1287 zijn er teksten van de dag (135)
        $json = [];

        /*
         * optie 1 random tussen 1287 en max (eerst een call doen om max te achterhalen)
         * optie 2 max -1
         */

        $npo = $this->getNotification(0);
        $total = $npo->total_count;

        $optie = '1';
        if ($optie == '1') {
            // random
            $min = 1287;
            $offset = rand($min, $total - 1);
        } else {
            // laatste
            $offset = $total - 1;
        }
        $found = false;
        do {
            $npo = $this->getNotification($offset++);

            if (is_object($npo->notifications[0]->data)) {
                //object data this must be welcome notification
            } else {
                $found = true;
                // heading
                $json['header'] = $npo->notifications[0]->headings->en;
                // text
                $json['content'] = $npo->notifications[0]->contents->en;
                // url
                $json['url'] = $npo->notifications[0]->url;
            }
        } while ($found == false);
        return json_encode($json);
    }

    private function getNotification($offset, $limit = 1)
    {
        $appId = env("ONE_SIGNAL_APP_ID");
        $key = env("ONE_SIGNAL_KEY");
        $url = 'https://onesignal.com/api/v1/notifications?app_id='.$appId;
        $url .= '&limit=' . $limit . '&offset=' . $offset;
        $headers = array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.$key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log(curl_error($ch) . '  One Signal API something went wrong..... try later');
        } else {
            curl_close($ch);
        }

        $npo = json_decode($data);
        return $npo;
    }

}