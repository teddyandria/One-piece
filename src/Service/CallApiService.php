<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getOnePieceData(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.api-onepiece.com/characters'
        );

        return $response->toArray();
    }
}
