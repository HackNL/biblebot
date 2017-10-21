
<?php
$apiResponse = file_get_contents('https://bijbel.eo.nl/api/EZR/3/2');
                $apiResponse = str_replace(array('/**/callback(', ');'), '', $apiResponse);
                $resultObject = json_decode($apiResponse);
echo '<pre>' . print_r($resultObject, true) . '</pre>';
   
   class Biblebook {
    
    public function __construct($dutchName, $apiName, $abbrevation, $chapterCount, $articleTitle, array $alternatives, $seven){
        $this->dutchName = $dutchName;
        $this->apiName = $apiName;
        $this->abbrevation = $abbrevation;
        $this->chapterCount = $chapterCount;
        $this->articleTitle = $articleTitle;
        $this->alternatives = $alternatives;
        $this->seven = $seven;
    }

    public function printArrayDefinition(){
        $alternativeDef = implode('\',\'', $this->alternatives);
        $alternativeDef = !empty($alternativeDef) ? '[\'' . $alternativeDef . '\']' : '[]';
        $EOL = PHP_EOL;
        echo "
              array('name'          => '$this->dutchName',
                    'apiName'       => '$this->apiName',
                    'abbrevation'   => '$this->abbrevation',
                    'chapterCount'  => $this->chapterCount,
                    'alternatives'  => $alternativeDef
              )";
    }

   }

   $books = [
            new Biblebook(
                'Genesis',
                'GEN',
                'Gen.',
                '50',
                'Inleiding op Genesis',
                ['geneses'],
                true
            ),
            new Biblebook(
                'Exodus',
                'EXO',
                'Ex.',
                '40',
                'Inleiding op Exodus',
                ['exodes'],
                true
            ),
            new Biblebook(
                'Leviticus',
                'LEV',
                'Lev.',
                '27',
                'Inleiding op Leviticus',
                ['levitikus'],
                true
            ),
            new Biblebook(
                'Numeri',
                'NUM',
                'Num.',
                '36',
                'Inleiding op Numeri',
                ['nummerie'],
                true
            ),
            new Biblebook(
                'Deuteronomium',
                'DEU',
                'Deut.',
                '34',
                'Inleiding op Deuteronomium',
                ['deu', 'deutronomium', 'deuteronomium'],
                true
            ),
            new Biblebook(
                'Jozua',
                'JOS',
                'Joz.',
                '24',
                'Inleiding op Jozua',
                ['josua'],
                true
            ),
            new Biblebook(

                'Rechters',
                'JDG',
                'Recht.',
                '21',
                'Inleiding op Rechters',
                ['rich', 'richteren', 'rigteren'],
                true
            ),
            new Biblebook(
                'Ruth',
                'RUT',
                'Ruth',
                '4',
                'Inleiding op Ruth',
                ['ru', 'rut', 'rud'],
                true
            ),
            new Biblebook(
                '1 Samuel',
                '1SA',
                '1 Sam.',
                '31',
                'Inleiding op 1 Samuel',
                ['samuel', 'sam'],
                true
            ),
            new Biblebook(
                '2 Samuel',
                '2SA',
                '2 Sam.',
                '24',
                'Inleiding op 2 Samuel',
                ['samuel', 'sam'],
                true
            ),
            new Biblebook(
                '1 Koningen',
                '1KI',
                '1 Kon.',
                '22',
                'Inleiding op 1 Koningen',
                ['koningen'],
                true
            ),
            new Biblebook(
                '2 Koningen',
                '2KI',
                '2 Kon.',
                '25',
                'Inleiding op 2 Koningen',
                ['koningen'],
                true
            ),
            new Biblebook(
                '1 Kronieken',
                '1CH',
                '1 Kron.',
                '29',
                'Inleiding op 1 Kronieken',
                ['1kro'],
                true
            ),
            new Biblebook(
                '2 Kronieken',
                '2CH',
                '2 Kron.',
                '36',
                'Inleiding op 2 Kronieken',
                ['2kro'],
                true
            ),
            new Biblebook(
                'Ezra',
                'EZR',
                'Ezra',
                '10',
                'Inleiding op Ezra',
                ['esra', 'esr', 'ezr'],
                true
            ),
            new Biblebook(
                'Nehemia',
                'NEH',
                'Neh.',
                '13',
                'Inleiding op Nehemia',
                ['neheemia'],
                true
            ),
            new Biblebook(
                'Ester',
                'EST',
                'Est.',
                '10',
                'Inleiding op Ester',
                ['esther'],
                true
            ),
            new Biblebook(
                'Job',
                'JOB',
                'Job',
                '42',
                'Inleiding op Job',
                ['jop'],
                true
            ),
            new Biblebook(
                'Psalmen',
                'PSA',
                'Ps.',
                '150',
                'Inleiding op Psalmen',
                ['psa', 'psalm', 'spalm'],
                true
            ),
            new Biblebook(
                'Spreuken',
                'PRO',
                'Spr.',
                '31',
                'Inleiding op Spreuken',
                ['sp'],
                true
            ),
            new Biblebook(
                'Prediker',
                'ECC',
                'Pred.',
                '12',
                'Inleiding op Prediker',
                ['pre', 'pr'],
                true
            ),
            new Biblebook(
                'Hooglied',
                'SNG',
                'Hoogl.',
                '8',
                'Inleiding op Hooglied',
                ['hoog', 'hoo'],
                true
            ),
            new Biblebook(
                'Jesaja',
                'ISA',
                'Jes.',
                '66',
                'Inleiding op Jesaja',
                ['jesajah'],
                true
            ),
            new Biblebook(
                'Jeremia',
                'JER',
                'Jer.',
                '52',
                'Inleiding op Jeremia',
                ['jr'],
                true
            ),
            new Biblebook(
                'Klaagliederen',
                'LAM',
                'Klaagl.',
                '5',
                'Inleiding op Klaagliederen',
                ['kla', 'kl'],
                true
            ),
            new Biblebook(

                'Ezechiël',
                'EZK',
                'Ezech.',
                '48',
                'Inleiding op Ezechiël',
                ['eze', 'ezegiel', 'esegiel'],
                true
            ),
            new Biblebook(
                'Daniël',
                'DAN',
                'Dan.',
                '12',
                'Inleiding op Daniël',
                ['da'],
                true
            ),
            new Biblebook(
                'Hosea',
                'HOS',
                'Hos.',
                '14',
                'Inleiding op Hosea',
                ['hoz', 'hozea'],
                true
            ),
            new Biblebook(
                'Joël',
                'JOL',
                'Joël',
                '4',
                'Inleiding op Joël',
                ['jl'],
                true
            ),
            new Biblebook(
                'Amos',
                'AMO',
                'Amos',
                '9',
                'Inleiding op Amos',
                ['am', 'amoz'],
                true
            ),
            new Biblebook(
                'Obadja',
                'OBA',
                'Ob.',
                '1',
                'Inleiding op Obadja',
                ['oba'],
                true
            ),
            new Biblebook(
                'Jona',
                'JON',
                'Jona',
                '4',
                'Inleiding op Jona',
                ['jon'],
                true
            ),
            new Biblebook(
                'Micha',
                'MIC',
                'Micha',
                '7',
                'Inleiding op Micha',
                ['mic', 'miga'],
                true
            ),
            new Biblebook(
                'Nahum',
                'NAM',
                'Nah.',
                '3',
                'Inleiding op Nahum',
                ['na'],
                true
            ),
            new Biblebook(
                'Habakuk',
                'HAB',
                'Hab.',
                '3',
                'Inleiding op Habakuk',
                ['habbakuk'],
                true
            ),
            new Biblebook(
                'Sefanja',
                'ZEP',
                'Sef.',
                '3',
                'Inleiding op Sefanja',
                ['zef', 'zefanja'],
                true
            ),
            new Biblebook(
                'Haggai',
                'HAG',
                'Hag.',
                '2',
                'Inleiding op Haggai',
                [],
                true
            ),
            new Biblebook(
                'Zacharia',
                'ZEC',
                'Zach.',
                '14',
                'Inleiding op Zacharia',
                ['za', 'zagaria', 'zaggaria', 'zagarja', 'sacharia'],
                true
            ),
            new Biblebook(
                'Maleachi',
                'MAL',
                'Mal.',
                '3',
                'Inleiding op Maleachi',
                ['malagie', 'malliagie', 'malliachie', 'malleachie', 'maleachie'],
                true
            ),
            new Biblebook(
                'Matteüs',
                'MAT',
                'Mat.',
                '28',
                'Het evangelie volgens Matteüs',
                ['mateus', 'matteus', 'matt'],
                false
            ),
            new Biblebook(
                'Marcus',
                'MRK',
                'Marc.',
                '16',
                'Het evangelie volgens Marcus',
                ['mar', 'markus', 'mark'],
                false
            ),
            new Biblebook(
                'Lucas',
                'LUK',
                'Luc.',
                '24',
                'Het evangelie volgens Lucas',
                ['lukas', 'luk', 'lu'],
                false
            ),
            new Biblebook(
                'Johannes',
                'JHN',
                'Joh.',
                '21',
                'Het evangelie volgens Johannes',
                ['johanes'],
                false
            ),
            new Biblebook(
                'Handelingen',
                'ACT',
                'Hand.',
                '28',
                'De handelingen van de apostelen',
                ['hd'],
                false
            ),
            new Biblebook(
                'Romeinen',
                'ROM',
                'Rom.',
                '16',
                'De brief aan de Romeinen',
                ['romijnen', 'ro', 'rm'],
                false
            ),
            new Biblebook(
                '1 Korintiërs',
                '1CO',
                '1 Kor.',
                '16',
                'De eerste brief aan de Korintiërs',
                ['1corienthiers', '1cor', '1korinthe', 'korinthiers', 'korinthe'],
                false
            ),
            new Biblebook(
                '2 Korintiërs',
                '2CO',
                '2 Kor.',
                '13',
                'De tweede brief aan de Korintiërs',
                ['2corienthiers', '2cor', '2korinthe', 'korinthiers', 'korinthe'],
                false
            ),
            new Biblebook(
                'Galaten',
                'GAL',
                'Gal.',
                '6',
                'De brief aan de Galaten',
                ['ga', 'gl'],
                false
            ),
            new Biblebook(
                'Efeziërs',
                'EPH',
                'Ef.',
                '6',
                'De brief aan de Efeziërs',
                ['efe', 'efesiers', 'efeze'],
                false
            ),
            new Biblebook(
                'Filippenzen',
                'PHP',
                'Filip.',
                '4',
                'De brief aan de Filippenzen',
                ['filiepenzen', 'filiepensen', 'fillip', 'fi', 'fil', 'fl'],
                false
            ),
            new Biblebook(
                'Kolossenzen',
                'COL',
                'Kol.',
                '4',
                'De brief aan de Kolossenzen',
                ['col'],
                false
            ),
            new Biblebook(
                '1 Tessalonicenzen',
                '1TH',
                '1 Tes.',
                '5',
                'De eerste brief aan de Tessalonicenzen',
                ['1tess', '1tessalonisensen', 'tessalonicenzen', 'tessalonisensen'],
                false
            ),
            new Biblebook(
                '2 Tessalonicenzen',
                '2TH',
                '2 Tes.',
                '3',
                'De tweede brief aan de Tessalonicenzen',
                ['2tess', '2tessalonisensen', 'tessalonicenzen', 'tessalonisensen'],
                false
            ),
            new Biblebook(
                '1 Timoteüs',
                '1TI',
                '1 Tim.',
                '6',
                'De eerste brief aan Timoteüs',
                ['1timo', '1timotheus', 'timo', 'timoteus', 'timotheus'],
                false
            ),
            new Biblebook(
                '2 Timoteüs',
                '2TI',
                '2 Tim.',
                '4',
                'De tweede brief aan Timoteüs',
                ['2timo', '2timotheus', 'timo', 'timoteus', 'timotheus'],
                false
            ),
            new Biblebook(
                'Titus',
                'TIT',
                'Tit.',
                '3',
                'De brief aan Titus',
                ['tites'],
                false
            ),
            new Biblebook(
                'Filemon',
                'PHM',
                'Filem.',
                '1',
                'De brief aan Filemon',
                ['file', 'fi', 'fil', 'fl'],
                false
            ),
            new Biblebook(
                'Hebreeën',
                'HEB',
                'Hebr.',
                '13',
                'De brief aan de Hebreeën',
                ['heb', 'hbr', 'hb', 'heebreeen', 'hebreen'],
                false
            ),
            new Biblebook(
                'Jakobus',
                'JAS',
                'Jak.',
                '5',
                'De brief van Jakobus',
                ['jac', 'jakobes', 'jacobes'],
                false
            ),
            new Biblebook(
                '1 Petrus',
                '1PE',
                '1 Petr.',
                '5',
                'De eerste brief van Petrus',
                ['1pet', 'petrus'],
                false
            ),
            new Biblebook(
                '2 Petrus',
                '2PE',
                '2 Petr.',
                '3',
                'De tweede brief van Petrus',
                [
                    '2pet',
                    'petrus',
                ],
                false
            ),
            new Biblebook(
                '1 Johannes',
                '1JN',
                '1 Joh.',
                '5',
                'De eerste brief van Johannes',
                ['1joh'],
                false
            ),
            new Biblebook(
                '2 Johannes',
                '2JN',
                '2 Joh.',
                '1',
                'De tweede brief van Johannes',
                ['2joh'],
                false
            ),
            new Biblebook(
                '3 Johannes',
                '3JN',
                '3 Joh.',
                '1',
                'De derde brief van Johannes',
                ['3joh'],
                false
            ),
            new Biblebook(
                'Judas',
                'JUD',
                'Judas',
                '1',
                'De brief van Judas',
                ['jud'],
                false
            ),
            new Biblebook(
                'Openbaring',
                'REV',
                'Op.',
                '22',
                'Openbaring van Johannes',
                ['open'],
                false
            ),
        ];
    

foreach($books as $book){
    echo $book->printArrayDefinition() . ',';
    // echo '<br />';
}