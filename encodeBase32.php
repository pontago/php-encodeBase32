<?php

function encodeBase32($str) {
  $table = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

  $buffer = unpack('C*', $str);
  $len = count($buffer);
  $n = 1;

  $buffer2 = '';
  while ($n <= $len) {
    $chr = $buffer[$n];
    $buffer2 .= sprintf('%08b', $chr);
    $n++;
  }

  $output = '';
  $len2 = strlen($buffer2);
  for ($i = 0; $i < $len2; $i += 5) {
    $chr = bindec(sprintf('%-05s', substr($buffer2, $i, 5)));
    $output .= substr($table, $chr, 1);
  }

  $len3 = strlen($output);
  if ($len3 > 0) {
    $num = $len3 > 8 ? 8 - ($len3 % 8) : 8 - $len3;
    $output .= str_repeat('=', $num);
  }
  return $output;
}


$arr = array('', 'f', 'fo', 'foo', 'foob', 'fooba', 'foobar');

foreach ($arr as $v) {
  echo encodeBase32($v) . "\n";
}
