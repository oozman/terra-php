<?php

namespace Oozman\Terra\Entities;

use Illuminate\Support\Arr;
use Oozman\Terra\Contracts\ConfigContract;

class Config implements ConfigContract
{
    protected array $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get LCD URL.
     *
     * @return string
     */
    public function lcdUrl(): string
    {
        return Arr::get($this->config, 'lcd_url');
    }

    /**
     * Get Chain ID.
     *
     * @return string
     */
    public function chainId(): string
    {
        return Arr::get($this->config, 'chain_id');
    }

    /**
     * Get node base path.
     *
     * @return string
     */
    public function terraCLIPath(): string
    {
        return Arr::get($this->config, 'terra_cli_path');
    }

    /**
     * Get address provider id.
     *
     * @return string
     */
    public function addressProviderId(): string
    {
        return Arr::get($this->config, 'address_provider_id');
    }

    /**
     * Get API URL.
     *
     * @return string
     */
    public function apiUrl(): string
    {
        return Arr::get($this->config, 'api_url');
    }
}