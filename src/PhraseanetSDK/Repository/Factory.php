<?php

/*
 * This file is part of Phraseanet SDK.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhraseanetSDK\Repository;

use PhraseanetSDK\Exception;
use PhraseanetSDK\EntityManager;

class Factory
{

    /**
     * Construct a new entity object
     *
     * @param  string                                $type the type of the repository
     * @param  PhraseanetSDK\EntityManager           $em   the entity manager
     * @return \PhraseanetSDK\Entity\EntityInterface
     * @throws Exception\InvalidArgumentException    when types is unknown
     */
    public static function build($type, EntityManager $em)
    {
        $namespace = '\\PhraseanetSDK\\Repository';

        $classname = ucfirst($type);
        $objectName = sprintf('%s\\%s', $namespace, $classname);

        if ( ! class_exists($objectName)) {
            throw new Exception\InvalidArgumentException(
                sprintf('Class %s does not exists', $objectName)
            );
        }

        return new $objectName($em);
    }
}
