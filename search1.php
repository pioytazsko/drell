<?php

echo "hello";

require_once('_t/_keybord_lang.php');



if (!$DB)

    include($DOCUMENT_ROOT . "/sadmin/_config.php");

include($DOCUMENT_ROOT . "/sadmin/_mysql.php");

setlocale(LC_ALL, "ru_RU.CP1251");



class Lingua_Stem_Ru {



    var $VERSION = "0.02";

    var $Stem_Caching = 0;

    var $Stem_Cache = array();

    var $VOWEL = '/аеиоуыэюя/';

    var $PERFECTIVEGROUND = '/((ив|ивши|ившись|ыв|ывши|ывшись)|((?<=[ая])(в|вши|вшись)))$/';

    var $REFLEXIVE = '/(с[яь])$/';

    var $ADJECTIVE = '/(ее|ие|ые|ое|ими|ыми|ей|ий|ый|ой|ем|им|ым|ом|его|ого|еых|ую|юю|ая|яя|ою|ею)$/';

    var $PARTICIPLE = '/((ивш|ывш|ующ)|((?<=[ая])(ем|нн|вш|ющ|щ)))$/';

    var $VERB = '/((ила|ыла|ена|ейте|уйте|ите|или|ыли|ей|уй|ил|ыл|им|ым|ены|ить|ыть|ишь|ую|ю)|((?<=[ая])(ла|на|ете|йте|ли|й|л|ем|н|ло|но|ет|ют|ны|ть|ешь|нно)))$/';

    var $NOUN = '/(а|ев|ов|ие|ье|е|иями|ями|ами|еи|ии|и|ией|ей|ой|ий|й|и|ы|ь|ию|ью|ю|ия|ья|я)$/';

    var $RVRE = '/^(.*?[аеиоуыэюя])(.*)$/';

    var $DERIVATIONAL = '/[^аеиоуыэюя][аеиоуыэюя]+[^аеиоуыэюя]+[аеиоуыэюя].*(?<=о)сть?$/';



    function s(&$s, $re, $to) {

        $orig = $s;

        $s = preg_replace($re, $to, $s);

        return $orig !== $s;

    } 



    function m($s, $re) {

        return preg_match($re, $s);

    }



    function stem_word($word) {

        $word = strtolower($word);

        $word = strtr($word, 'ё', 'е'); // замена ё на е, что бы учитывалась как одна и та же буква

        # Check against cache of stemmed words

        if ($this->Stem_Caching && isset($this->Stem_Cache[$word])) {

            return $this->Stem_Cache[$word];

        }

        $stem = $word;

        do {

            if (!preg_match($this->RVRE, $word, $p))

                break;

            $start = $p[1];

            $RV = $p[2];

            if (!$RV)

                break;



            # Step 1

            if (!$this->s($RV, $this->PERFECTIVEGROUND, '')) {

                $this->s($RV, $this->REFLEXIVE, '');



                if ($this->s($RV, $this->ADJECTIVE, '')) {

                    $this->s($RV, $this->PARTICIPLE, '');

                } else {

                    if (!$this->s($RV, $this->VERB, ''))

                        $this->s($RV, $this->NOUN, '');

                }

            }



            # Step 2

            $this->s($RV, '/и$/', '');



            # Step 3

            if ($this->m($RV, $this->DERIVATIONAL))

                $this->s($RV, '/ость?$/', '');



            # Step 4

            if (!$this->s($RV, '/ь$/', '')) {

                $this->s($RV, '/ейше?/', '');

                $this->s($RV, '/нн$/', 'н');

            }



            $stem = $start . $RV;

        } while (false);

        if ($this->Stem_Caching)

            $this->Stem_Cache[$word] = $stem;

        return $stem;

    }



    function stem_caching($parm_ref) {

        $caching_level = @$parm_ref['-level'];

        if ($caching_level) {

            if (!$this->m($caching_level, '/^[012]$/')) {

                die(__CLASS__ . "::stem_caching() - Legal values are '0','1' or '2'. '$caching_level' is not a legal value");

            }

            $this->Stem_Caching = $caching_level;

        }

        return $this->Stem_Caching;

    }



    function clear_stem_cache() {

        $this->Stem_Cache = array();

    }



}



$arraySpecialChars = array('/', ']', '[', '-', '\\', '+', '\'', '&quot;');

header("Content-type: text/html; charset=windows-1251");

$search = $_REQUEST['search'];

$search = iconv('utf-8', 'windows-1251', $search);

$search = addslashes($search);

$search = htmlspecialchars($search);

$search = stripslashes($search);

$search = switcher($search);

foreach ($arraySpecialChars as $item) {

    $search = str_replace($item, '', $search);

}

$search = preg_replace('/ {2,}/', ' ', $search);

$search = trim($search);

$searchKeywordArray = explode(' ', $search);

if (count($searchKeywordArray) <= 1) {

    preg_match_all('/([A-Za-zА-Яа-я]{1,})|([0-9]{1,})/', $search, $searchKeywordArray);

    $searchKeywordArray = $searchKeywordArray[0];

}



$usdCurs = 0;

$sqlCurrency = "SELECT f1 FROM " . $module_name . " WHERE id=107";

$usdCurs = mysql_result($Q->query($DB, $sqlCurrency), 0, 0);

$usdCurs = (float) $usdCurs;



$stemLang = new Lingua_Stem_Ru();

$sqlQuery = 'FROM ' . $module_name . ' WHERE ';

$sqlQueryPrefix = 'id<> 74 AND aname=\'e4\'';

$sqlQueryTerm1 = '';

$sqlQueryTerm2 = '';

$writeTerm2 = false;

foreach ($searchKeywordArray as $key => $value) {

    if (!empty($value)) {

        if ($value == '###') {

            $writeTerm2 = true;

        } else {

            $searchKeywordArray[$key] = $stemLang->stem_word($value);

            if ($writeTerm2) {

                if ($sqlQueryTerm2 != '')

                    $sqlQueryTerm2.=' AND ';

                $sqlQueryTerm2.= 'name LIKE \'%' . $searchKeywordArray[$key] . '%\'';

            } else {

                if ($sqlQueryTerm1 != '')

                    $sqlQueryTerm1.=' AND ';

                $sqlQueryTerm1.= 'name LIKE \'%' . $searchKeywordArray[$key] . '%\'';

            }

        }

    }

}

$sqlQuery = $sqlQueryPrefix . ' AND ';

if ($writeTerm2) {

    $sqlQuery.='((' . $sqlQueryTerm1 . ') OR (' . $sqlQueryTerm2 . '))';

} else {

    $sqlQuery.=$sqlQueryTerm1;

}

$sqlQuery = 'FROM ' . $module_name . ' WHERE ' . $sqlQuery;

$sqlCount = 'SELECT count(*) ' . $sqlQuery;

$countProduct = mysql_result($Q->query($DB, $sqlCount), 0, 0);

$sqlQuery = 'SELECT * ' . $sqlQuery . ' ORDER BY f10 LIMIT 0,5';

$categotyList = array();

echo $search;

if ($sqlQuery != '') {

    $resultQuery = $Q->query($DB, $sqlQuery);echo mysql_error();

    if (mysql_num_rows($resultQuery) != 0) {

        while ($sqlItem = mysql_fetch_array($resultQuery)) {

            $categotyList[$sqlItem['rid']] = intval($categotyList[$sqlItem['rid']]) + 1;

            if (!empty($sqlItem['url'])) {

                $linkHref = 'http://www.drel.by/' . $sqlItem['url'];

            } else {

                $linkHref = 'http://www.drel.by/catalog.php?id=' . $sqlItem['id'];

            }

            echo '<div class="product-item">';

            echo '<div class="image"><a href="' . $linkHref . '"><img src="/shortimage.php?path=attachments--' . $sqlItem['id'] . '--big.jpg&x=62&y=62"></a></div>';

            echo '<div class="item-detail">';

            echo '<div class="item-title">';

            $showName = $sqlItem['name'];

            foreach ($searchKeywordArray as $key => $value) {

                $nameLowerCase = strtolower($showName);

                $lexemLowerCase = strtolower($searchKeywordArray[$key]);

                $posLexem = strpos($nameLowerCase, $lexemLowerCase);

                $lengthLexem = strlen($lexemLowerCase);

                if ($posLexem !== false) {

                    $showName = substr($showName, 0, $posLexem) . '<b>' . substr($showName, $posLexem, $lengthLexem) . '</b>' . substr($showName, $posLexem + $lengthLexem);

                }

            }

            //echo $sqlItem['name'];

            echo '<a href="' . $linkHref . '">' . $showName . '</a>';

            echo '</div>';

            $rating = intval($sqlItem['f4']);

            echo '<div class="item-rate">';

            for ($cycle = 1; $cycle <= 5; $cycle++) {

                if ($cycle <= $rating) {

                    echo '<span class="rate_active"></span>';

                } else {

                    echo '<span class="rate_inactive"></span>';

                }

            }

            echo '</div>';

            echo '<div class="item-descript">';

            echo $sqlItem['anons'];

            echo '</div>';

            echo '<div class="cost-item">';

            echo '<span class="title">Цена:</span>';

            $costProduct = (float) $sqlItem['f1'];

            $costProduct = $costProduct * $usdCurs * 1000;

            $costOld = (float) $sqlItem['f5'];

            $costOld = $costOld * $usdCurs * 1000;

            if (!empty($sqlItem['f5'])) {

                echo '<span class="old-cost">' . number_format($costOld, '0', '', ' ') . '</span>&nbsp;';

            }

            echo '<span class="new-cost">' . number_format($costProduct, '0', '', ' ') . '</span>&nbsp;';

            echo '<span class="currency">руб.</span>';

            echo '</div>';

            echo '<div class="button-item">';

            echo '<a href="' . $linkHref . '"><img src="/images/spisok/buy.jpg" border="0"></a>';

            echo '</div>';

            echo '</div>';

            echo '</div>';

        }

        echo '<div class="count-item">';

        echo '<a href="#" id="button-show-all">Всего: ' . $countProduct . '. Показать все</a>';

        echo '</div>';

        arsort($categotyList);

        $countCategory = 4;

        $showCatgory = 0;

        foreach ($categotyList as $key => $item) {

            $sqlCurrency = "SELECT name,url FROM " . $module_name . " WHERE id=" . $key;

            $categoryName = mysql_result($Q->query($DB, $sqlCurrency), 0, 0);

            $categoryUrl = mysql_result($Q->query($DB, $sqlCurrency), 0, 1);

            echo '<div class="category-item"><a href="/' . $categoryUrl . '">' . $categoryName . '</a></div>';

            $showCatgory ++;

            if ($showCatgory == $countCategory) {

                break;

            }

        }

    } else {

        echo "Нет результатов";

    }

}

?>