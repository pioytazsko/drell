<?php
function switcher($text){
  $return_string = $text;
  $letter_array = array('q' => '�', 'w' => '�', 'e' => '�', 'r' => '�', 't' => '�', 'y' => '�', 'u' => '�', 'i' => '�', 'o' => '�', 'p' => '�', '[' => '�', ']' => '�', 'a' => '�', 's' => '�', 'd' => '�', 'f' => '�', 'g' => '�', 'h' => '�', 'j' => '�', 'k' => '�', 'l' => '�', ';' => '�', '\'' => '�', 'z' => '�', 'x' => '�', 'c' => '�', 'v' => '�', 'b' => '�', 'n' => '�', 'm' => '�', ',' => '�', '.' => '�','Q' => '�', 'W' => '�', 'E' => '�', 'R' => '�', 'T' => '�', 'Y' => '�', 'U' => '�', 'I' => '�', 'O' => '�', 'P' => '�', '[' => '�', ']' => '�', 'A' => '�', 'S' => '�', 'D' => '�', 'F' => '�', 'G' => '�', 'H' => '�', 'J' => '�', 'K' => '�', 'L' => '�', ';' => '�', '\'' => '�', 'Z' => '?', 'X' => '�', 'C' => '�', 'V' => '�', 'B' => '�', 'N' => '�', 'M' => '�', ',' => '�', '.' => '�', );
  foreach($letter_array as $key=>$value) {
      $return_string = str_replace($key,$value,$return_string);
  }
  if ($return_string != $text) $return_string = $text.' ### '.$return_string;
  return $return_string;
}
?>