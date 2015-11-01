<?php

namespace AppBundle\Command;

use AppBundle\Entity\Jailbreak;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateJailbreakCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('jailbreaks:migrate')
            ->setDescription('Migrate jailbreaks in from jailbreaks.json')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $jsonFile = file_get_contents(
            $this->getContainer()->get('kernel')->getRootDir() . "/data/jailbreaks.json"
        );

        foreach (json_decode($jsonFile)->jailbreaks as $jailbreak) {

            $output->writeln(
                sprintf("Imported: %s for iOS %s", $jailbreak->name, $jailbreak->ios->start)
            );

            $jb = new Jailbreak();
            $jb->setJailbroken($jailbreak->jailbroken);
            $jb->setName($jailbreak->name);
            $jb->setVersion($jailbreak->version);
            $jb->setUrl($jailbreak->url);
            $jb->setStartiOS($jailbreak->ios->start);

            if (isset($jailbreak->ios->end)) {
                $jb->setEndiOS($jailbreak->ios->end);
            }

            $jb->setCaveats($jailbreak->caveats);

            foreach ($jailbreak->platforms as $platform) {
                switch ($platform) {
                    case "Windows":
                        $jb->setWindows(true);
                        break;
                    case "OS X":
                        $jb->setOsx(true);
                        break;
                    case "Linux":
                        $jb->setLinux(true);
                        break;
                    default:
                        $output->writeln("Platform not found");
                        break;
                }
            }

            $em = $this->getContainer()->get('doctrine')->getEntityManager();

            $em->persist($jb);
            $em->flush();
        }

    }
}
