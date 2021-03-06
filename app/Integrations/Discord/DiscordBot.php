<?php

namespace App\Integrations\Discord;


use GuzzleHttp\Exception\RequestException;
use Log;

class DiscordBot
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    public function __construct(string $url, string $bearerToken)
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $url,
            'timeout'  => 5,
            'headers'  => [
                'Authorization' => "Bearer " . $bearerToken
            ]
        ]);
    }


    /**
     * @param array $songData
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function eventNewSong(array $songData)
    {
        $uploaderName = $songData['uploader'];
        $songKey = $songData['key'];
        try {
            $response = $this->client->request('POST', 'SongUploaded', [
                'json' => [
                    'creatorName' => $uploaderName,
                    'songUrl'     => route('browse.detail', ['key' => $songKey])
                ]
            ]);
            Log::debug('Body: ' . $response->getBody());
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            Log::error($e->getRequest()->getHeaders());
            Log::error($e->getRequest()->getBody());
        }
    }
}