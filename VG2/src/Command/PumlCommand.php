<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:puml',
    description: 'Create puml class diagram from Entities declared in `src/Entity`',
)]
class PumlCommand extends Command
{
    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

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

        foreach (getDirContents('./src/Entity') as $value) {
            require ($value);
            
        }

        $entities = [];
        $graph = [];

        foreach (get_declared_classes() as $value) {
            $entity_name = "";
            $reflector = new \ReflectionClass($value);
            $attr = $reflector->getAttributes();  
            foreach ($attr as $a) {
                // echo "" . $reflector->getShortName() . "\n";
                if ($a->getName() == "Doctrine\ORM\Mapping\Entity") {
                    $entity_name = $reflector->getShortName();    
                }
            }  
            $properties = [];
            $props = $reflector->getProperties();  
            foreach ($props as $p) {
                // echo "**** " . $p->getName() . "\n";
                // if ($p->getName() == "Doctrine\ORM\Mapping\Entity") {
                    // $entities[] = $name;
                // }
                $p_attrs = $p->getAttributes();  
                foreach ($p_attrs as $p_a) {
                    // echo ">>>>>>>> " . $p_a->getName() . "\n";
                    if ($p_a->getName() == "Doctrine\ORM\Mapping\Column") {
                        $properties[] = $p->getName();
                    }
                    // $last = explode("\\",$p_a->getName());
                    @$last = end ((explode("\\",$p_a->getName())));
                    if (in_array($last, ["OneToMany", "ManyToOne", "ManyToMany", "OneToOne"])) {
                        foreach($p_a->getArguments() as $arg_k => $arg_v) {
                            if ($arg_k == "targetEntity") {
                                // echo ">>>>>>>>>>>> $arg_v\n";
                                $graph[] = [$reflector->getShortName(), @end ((explode("\\",$arg_v))), $last];
                            }
                        }
                        $properties[] = "**" . $p->getName() . "**";
                    }
                }  
            }
            if ($entity_name!="") $entities[$entity_name] = $properties;
            
        } 

        $data = "";
        foreach ($entities as $key => $props) {
            $data .= "class $key {\n";
                foreach ($props as $v) {
                    $data .= "\t$v\n";
                }
            $data .= "}\n\n";
        }

        foreach ($graph as $v) {
            if ($v[2] == "OneToMany")
                $data .= $v[0] . " \"1\"--\"*\" " . $v[1] . "\n";
            if ($v[2] == "ManyToOne")
                $data .= $v[0] . " \"*\"--\"1\" " . $v[1] . "\n";
            if ($v[2] == "ManyToMany")
                $data .= $v[0] . " \"*\"--\"*\" " . $v[1] . "\n";
            if ($v[2] == "OneToOne")
                $data .= $v[0] . " \"1\"--\"1\" " . $v[1] . "\n";
        }

        $data.= "\n\nhide methods\nhide circle\n\n";
        file_put_contents("./puml/index.puml", $data);



        return Command::SUCCESS;
    }
}
