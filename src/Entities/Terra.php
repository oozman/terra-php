<?php

namespace Oozman\Terra\Entities;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Oozman\Terra\Contracts\ConfigContract;
use Oozman\Terra\Contracts\TerraContract;
use Oozman\Terra\Contracts\WalletContract;
use Oozman\Terra\Exceptions\ConfigException;
use Oozman\Terra\Exceptions\RequestException;
use Oozman\Terra\Exceptions\WalletException;

class Terra implements TerraContract
{
    protected ConfigContract $config;
    protected Client $client;

    public function __construct(ConfigContract $config)
    {
        $this->config = $config;
        $this->client = new Client();
    }

    /**
     * Get wallet info.
     *
     * @param   string  $mnemonicKey
     *
     * @return WalletContract
     * @throws ConfigException
     * @throws RequestException
     * @throws WalletException
     */
    public function wallet(string $mnemonicKey): WalletContract
    {
        $baseUrl = $this->config->baseUrl('get_wallet');

        if ( ! $baseUrl) {
            throw new ConfigException('Base url is empty. Set: `get_wallet`');
        }

        try {
            $response = $this->client->post($baseUrl, [
                'headers' => [
                    'X-App-Environment' => $this->config->environment(),
                ],
                'json'    => [
                    'mnemonic_key' => $mnemonicKey,
                ],
            ]);
        } catch (GuzzleException $e) {
            throw new RequestException($e->getMessage());
        }

        if ($response->getStatusCode() !== 200) {
            throw new WalletException('Unable to get wallet info.');
        }

        try {
            $json = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            throw new WalletException('Unable to parse wallet response.');
        }

        if ($error = Arr::get($json, 'error')) {
            throw new WalletException($error);
        }

        return new Wallet(Arr::get($json, 'data'));
    }
}