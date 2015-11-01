<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Jailbreak;

/**
 * Class IconHelperExtension
 * @package AppBundle\Twig
 */
class IconHelperExtension extends \Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'icon_helper';
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('iconNames', array($this, 'getIconNames')),
        ];
    }

    /**
     * @param Jailbreak $jb
     *
     * @return array
     */
    public function getIconNames(Jailbreak $jb)
    {
        $names = [];

        if ($jb->getWindows()) {
            $names["Windows"] = "windows";
        }

        if ($jb->getOsx()) {
            $names["OS X"] = "apple";
        }


        if ($jb->getLinux()) {
            $names["Linux"] = "linux";
        }

        if ($jb->getMobilesafari()) {
            $names["Mobile Safari"] = "mobile";
        }

        if (count($names) === 0) {
            $names["Unknown"] = "question";
        }

        return $names;
    }
}