<?php

$c = [12, 55, 89, "mlk"];

$c[8] = 666;

$c[] = 777;
$c["macase"] = 888;

$c[] = 999;

array_push($c, "fin");
array_unshift($c, "debut");
array_unshift($c, "debut");


foreach ($c as $z => $m) {
    echo $z . "=" . $m . "\n";
}



