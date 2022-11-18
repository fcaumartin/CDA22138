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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <table >
        <?php foreach ($tab as $key => $value) { ?>
                <tr class="bordure">
                    <td><?=$key ?></td>
                    <td><?=$value ?></td>
                </tr>
        <?php } ?>

    </table>
</body>
</html>




