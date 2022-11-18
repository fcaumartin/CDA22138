<?php

$departements = array(
    "Hauts-de-france" => array(
        "Aisne", 
        "Nord", 
        "Oise", 
        "Pas-de-Calais", 
        "Somme"
    ),
    "Bretagne" => array("Côtes d'Armor", "Finistère", "Ille-et-Vilaine", "Morbihan"),
    "Grand-Est" => array("Ardennes", "Aube", "Marne", "Haute-Marne", "Meurthe-et-Moselle", "Meuse", "Moselle", "Bas-Rhin", "Haut-Rhin", "Vosges"),
    "Normandie" => array("Calvados", "Eure", "Manche", "Orne", "Seine-Maritime")
);

ksort($departements);

foreach ($departements as $key => $value) {
    echo "<b>$key :</b>";
    foreach ($value as $d) {
        echo $d . ",";
    }
    echo "<br>";
}



foreach ($departements as $key => $value) {
    echo "<b>$key :</b>";
    echo count($value);
    echo "<br>";
}