<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            if (is_file($path) && pathinfo($path, PATHINFO_EXTENSION)=="php") {
                $results[] = $path;
            }
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
            // $results[] = $path;
        }
    }

    return $results;
}

foreach (getDirContents('../src') as $value) {
    require ($value);
    
}

$entities = [];

foreach (get_declared_classes() as $value) {
    $entity_name = "";
    $reflector = new \ReflectionClass($value);
    $attr = $reflector->getAttributes();  
    foreach ($attr as $a) {
        // echo "*** " . $a->getName() . "\n";
        if ($a->getName() == "Doctrine\ORM\Mapping\Entity") {
            $entity_name = $reflector->getName();    
        }
    }  
    $properties = [];
    $props = $reflector->getProperties();  
    foreach ($props as $p) {
        // echo "*** " . $p->getName() . "\n";
        // if ($p->getName() == "Doctrine\ORM\Mapping\Entity") {
            // $entities[] = $name;
        // }
        $p_attrs = $p->getAttributes();  
        foreach ($p_attrs as $p_a) {
            // echo "***>>> " . $p_a->getName() . "\n";
            if ($p_a->getName() == "Doctrine\ORM\Mapping\Column") {
                $properties[] = $p->getName();
            }
        }  
    }
    if ($entity_name!="") $entities[$entity_name] = $properties;
    
} 


print_r($entities);


// $reflector = new \ReflectionClass(Produit::class);
// $attributes = $reflector->getAttributes();

// foreach ($attributes as $key => $value) {
//     echo "$key $value\n";
// }