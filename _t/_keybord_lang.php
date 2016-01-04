<?php
function switcher($text){
  $return_string = $text;
  $letter_array = array('q' => 'é', 'w' => 'ö', 'e' => 'ó', 'r' => 'ê', 't' => 'å', 'y' => 'í', 'u' => 'ã', 'i' => 'ø', 'o' => 'ù', 'p' => 'ç', '[' => 'õ', ']' => 'ú', 'a' => 'ô', 's' => 'û', 'd' => 'â', 'f' => 'à', 'g' => 'ï', 'h' => 'ð', 'j' => 'î', 'k' => 'ë', 'l' => 'ä', ';' => 'æ', '\'' => 'ý', 'z' => 'ÿ', 'x' => '÷', 'c' => 'ñ', 'v' => 'ì', 'b' => 'è', 'n' => 'ò', 'm' => 'ü', ',' => 'á', '.' => 'þ','Q' => 'É', 'W' => 'Ö', 'E' => 'Ó', 'R' => 'Ê', 'T' => 'Å', 'Y' => 'Í', 'U' => 'Ã', 'I' => 'Ø', 'O' => 'Ù', 'P' => 'Ç', '[' => 'Õ', ']' => 'Ú', 'A' => 'Ô', 'S' => 'Û', 'D' => 'Â', 'F' => 'À', 'G' => 'Ï', 'H' => 'Ð', 'J' => 'Î', 'K' => 'Ë', 'L' => 'Ä', ';' => 'Æ', '\'' => 'Ý', 'Z' => '?', 'X' => '÷', 'C' => 'Ñ', 'V' => 'Ì', 'B' => 'È', 'N' => 'Ò', 'M' => 'Ü', ',' => 'Á', '.' => 'Þ', );
  foreach($letter_array as $key=>$value) {
      $return_string = str_replace($key,$value,$return_string);
  }
  if ($return_string != $text) $return_string = $text.' ### '.$return_string;
  return $return_string;
}
?>