<?php

namespace Gamesites\Payment\Integration\Przelewy24\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RestClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 15,
        ]);
    }

    /**  @throws GuzzleException */
    public function post(string $uri, array $body, string $secret): array
    {
        $res = $this->client->post($uri, [
            'headers' => [
                'content-type' => 'application/json',
                'authorization' => 'basic ' . base64_encode($body['posId'] . $secret)
            ],
            'body' => json_encode($body)
        ]);

        return json_decode($res->getBody()->getContents(), true);
    }

    /**  @throws GuzzleException */
    public function put(string $uri, array $body, string $secret): array
    {
        $res = $this->client->put($uri, [
            'headers' => [
                'content-type' => 'application/json',
                'authorization' => 'basic ' . base64_encode($body['posId'] . $secret)
            ],
            'body' => json_encode($body)
        ]);

        return json_decode($res->getBody()->getContents(), true);
    }
}
