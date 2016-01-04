<?php

setlocale(LC_ALL, "ru_RU.CP1251");

class Lingua_Stem_Ru {

    var $VERSION = "0.02";
    var $Stem_Caching = 0;
    var $Stem_Cache = array();
    var $VOWEL = '/аеиоуыэю€/';
    var $PERFECTIVEGROUND = '/((ив|ивши|ившись|ыв|ывши|ывшись)|((?<=[а€])(в|вши|вшись)))$/';
    var $REFLEXIVE = '/(с[€ь])$/';
    var $ADJECTIVE = '/(ее|ие|ые|ое|ими|ыми|ей|ий|ый|ой|ем|им|ым|ом|его|ого|еых|ую|юю|а€|€€|ою|ею)$/';
    var $PARTICIPLE = '/((ивш|ывш|ующ)|((?<=[а€])(ем|нн|вш|ющ|щ)))$/';
    var $VERB = '/((ила|ыла|ена|ейте|уйте|ите|или|ыли|ей|уй|ил|ыл|им|ым|ены|ить|ыть|ишь|ую|ю)|((?<=[а€])(ла|на|ете|йте|ли|й|л|ем|н|ло|но|ет|ют|ны|ть|ешь|нно)))$/';
    var $NOUN = '/(а|ев|ов|ие|ье|е|и€ми|€ми|ами|еи|ии|и|ией|ей|ой|ий|й|и|ы|ь|ию|ью|ю|и€|ь€|€)$/';
    var $RVRE = '/^(.*?[аеиоуыэю€])(.*)$/';
    var $DERIVATIONAL = '/[^аеиоуыэю€][аеиоуыэю€]+[^аеиоуыэю€]+[аеиоуыэю€].*(?<=о)сть?$/';

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
        $word = strtr($word, 'Є', 'е'); // замена Є на е, что бы учитывалась как одна и та же буква
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
$search = $searchword;
$search = addslashes($search);
$search = htmlspecialchars($search);
$search = stripslashes($search);
$search = switcher($search);
foreach ($arraySpecialChars as $item) {
    $search = str_replace($item, ' ', $search);
}
$search = preg_replace('/ {2,}/', ' ', $search);
$search = trim($search);
$searchKeywordArray = explode(' ', $search);
if (count($searchKeywordArray) <= 1) {
    preg_match_all('/([A-Za-zј-яа-€]{1,})|([0-9]{1,})/', $search, $searchKeywordArray);
    $searchKeywordArray = $searchKeywordArray[0];
}
$stemLang = new Lingua_Stem_Ru();
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
$sqlQuery .= ' ORDER BY f10';
?>