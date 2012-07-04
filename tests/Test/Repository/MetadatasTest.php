<?php

namespace Test\Repository;

require_once 'Repository.php';

use PhraseanetSDK\Client;
use PhraseanetSDK\Repository\Metadatas;
use PhraseanetSDK\Tools\Entity\Manager;

class MetadatasTest extends Repository
{

    public function testfindMetadatasByRecord()
    {
        $client = $this->getClient($this->getSampleResponse('repository/metadatas/byRecord'));
        $metaRepository = new Metadatas(new Manager($client));
        $metas = $metaRepository->findByRecord(1, 1);
        $this->assertIsCollection($metas);
        foreach ($metas as $meta) {
            $this->checkMetadatas($meta);
        }
    }

    /**
     * @expectedException PhraseanetSDK\Exception\UnauthorizedException
     */
    public function testfindMetadatasByRecordExcpetion()
    {
        $client = $this->getClient($this->getSampleResponse('401'), 401);
        $metaRepository = new Metadatas(new Manager($client));
        $metaRepository->findByRecord(1, 1);
    }

    /**
     * @expectedException PhraseanetSDK\Exception\RuntimeException
     */
    public function testfindMetadatasByRecordRuntimeExcpetion()
    {
        $client = $this->getClient($this->getSampleResponse('empty'));
        $metaRepository = new Metadatas(new Manager($client));
        $metaRepository->findByRecord(1, 1);
    }

}
