<?php

$tab = [
    "janvier" => 31,
    "février" => 28,
    "mars" => 31,
    "avril" => 30,
    "mai" => 31,
    "juin" => 30,
    "juillet" => 31,
    "aout" => 31,
    "septembre" => 30,
    "octobre" => 31,
    "novembre" => 30,
    "décembre" => 31
];

echo "<table>";
foreach ($tab as $key => $value) {
    echo "<tr class='mabordure'>";
    echo "<td>$key</td><td>$value</td>";
    echo "</tr>";
}
echo "</table>";
