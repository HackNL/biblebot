<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 10/21/2017
 * Time: 12:35 AM
 */

namespace App\Http\Controllers;


use App\ApiHandler;

class ApiCallsController extends Controller
{
    public function test()
    {
        return "test";
    }

    public function getVerseOfTheDay()
    {
        $api = new ApiHandler();
        return $api->getVerseOfTheDay();
    }
}