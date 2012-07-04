<?php

namespace Test\Repository;

require_once 'Repository.php';

use PhraseanetSDK\Client;
use PhraseanetSDK\Repository\DataboxStatus;
use PhraseanetSDK\Tools\Entity\Manager;

class DataboxStatusTest extends Repository
{

    public function testFindByDatabox()
    {
        $client = $this->getClient($this->getSampleResponse('repository/databoxStatus/findAll'));
        $databoxStatusRepository = new DataboxStatus(new Manager($client));
        $databoxStatus = $databoxStatusRepository->findByDatabox(1);

        foreach ($databoxStatus as $status) {
            $this->checkDataBoxStatus($status);
        }
    }

    /**
     * @expectedException PhraseanetSDK\Exception\UnauthorizedException
     */
    public function testFindByDataboxException()
    {
        $client = $this->getClient($this->getSampleResponse('401'), 401);
        $databoxStatusRepository = new DataboxStatus(new Manager($client));
        $databoxStatusRepository->findByDatabox(1);
    }

    /**
     * @expectedException PhraseanetSDK\Exception\RuntimeException
     */
    public function testFindByDataboxRuntimeException()
    {
        $client = $this->getClient($this->getSampleResponse('empty'));
        $databoxStatusRepository = new DataboxStatus(new Manager($client));
        $databoxStatusRepository->findByDatabox(1);
    }
}
