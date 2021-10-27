<?php 

// testowane używając komendy "php.exe -a -d auto_prepend_file=D:\project_hsi_1\app.php"

include_once __DIR__ . '/game.php';

$Game = new Game();
$KoncowaTabela = array();

for($i = 1; $i <= 10; $i++)
{
  echo "-> Runda: " . $i . "\n";
  $throw_one = (int)readline('Strąconych kręgli rzut pierwszy: ');
  $throw_two = 0;
  if($throw_one > 10)
  {
    $throw_one = 10;
    echo "[WARNING] Błędnie podano wartość pierwszego rzutu (przekroczono 10 kregli) - wartość została poprawiona na '" . $throw_one . "'\n";
  }
  if($throw_one < 10) 
  {
    $throw_two = (int)readline('Strąconych kręgli rzut drugi: ');
    if($throw_one + $throw_two > 10)
    {
      $throw_two = 10 - $throw_one;
      echo "[WARNING] Błędnie podano wartość drugiego rzutu (przekroczono 10 kregli) - wartość została poprawiona na '" . $throw_two . "'\n";
    }
  }
  $Game->roll( $throw_one );
  $Game->roll( $throw_two );
  $KoncowaTabela[$i] = array($throw_one, $throw_two, $Game->getScore());
}
echo "\nGra zakończona.\n";

foreach($KoncowaTabela as $round => $data)
{
  echo "Runda " . $round . " " . $data[0] . "|" . $data[1] . " => " . $data[2] . "\n";
}
echo "\nWynik końcowy: " . $Game->getScore();
exit; // przy uzyciu inreractive shell wyjdz z niego.
?>