<?php
namespace App;

class BookMapper {
	
	protected static $bookMapping  = array(
			"Genesis"           => "GEN",
			"Exodus"            => "EXO",
			"Leviticus"         => "LEV",
			"Numeri"            => "NUM",
			"Deutronomium"      => "DEU",
			"Jozua"             => "JOS",
			"Richteren"         => "JDG",
			"Ruth"              => "RUT",
			"1 Samuël"          => "1SA",
			"2 Samuël"          => "2SA",
			"1 Koningen"        => "1KI",
			"2 Koningen"        => "2KI",
			"1 Kronieken"       => "1CH",
			"2 Kronieken"       => "2CH",
			"Ezra"              => "EZR",
			"Nehemia"           => "NEH",
			"Esther"            => "EST",
			"Job"               => "JOB",
			"Psalmen"           => "PSA",
			"Spreuken"          => "PRO",
			"Prediker"          => "ECC",
			"Hooglied"          => "SNG",
			"Jesaja"            => "ISA",
			"Jeremia"           => "JER",
			"Klaagliederen"     => "LAM",
			"Ezechiël"          => "EZK",
			"Daniël"            => "DAN",
			"Hosea"             => "HOS",
			"Joël"              => "JOL",
			"Amos"              => "AMO",
			"Obadja"            => "OBA",
			"Jona"              => "JON",
			"Micha"             => "MIC",
			"Nahum"             => "NAM",
			"Habakuk"           => "HAB",
			"Sefanja"           => "ZEP",
			"Haggaï"            => "HAG",
			"Zacharia"          => "ZEC",
			"Maleachi"          => "MAL",
			"Mattheüs"          => "MAT",
			"Markus"            => "MRK",
			"Lukas"             => "LUK",
			"Johannes"          => "JHN",
			"Handelingen"       => "ACT",
			"Romeinen"          => "ROM",
			"1 Korinthiërs"     => "1CO",
			"2 Korinthiërs"     => "2CO",
			"Galaten"           => "GAL",
			"Efeziërs"          => "EPH",
			"Filippenzen"       => "PHP",
			"Kolossenzen"       => "COL",
			"1 Tessalonicenzen" => "1TH",
			"2 Tessalonicenzen" => "2TH",
			"1 Timotheüs"       => "1TI",
			"2 Timotheüs"       => "2TI",
			"Titus"             => "TIT",
			"Filemon"           => "PHM",
			"Hebreeërs"         => "HEB",
			"Jakobus"           => "JAS",
			"1 Petrus"          => "1PE",
			"2 Petrus"          => "2PE",
			"1 Johannes"        => "1JN",
			"2 Johannes"        => "2JN",
			"3 Johannes"        => "3JN",
			"Judas"             => "JUD",
			"Openbaringen"      => "REV"
		);

	public static function getApiNameByName($name){
		if(isset(self::$bookMapping[$name])){
			return self::$bookMapping[$name];
		}
		return false;
	}
	
}