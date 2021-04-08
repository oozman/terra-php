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
     * Get environment.
     *
     * @return string
     */
    public function environment(): string
    {
        return Arr::get($this->config, 'environment');
    }

    /**
     * Get function base url.
     *
     * @param   string|null  $key
     *
     * @return string
     */
    public function baseUrl(?string $key): string
    {
        return Arr::get($this->config, 'base_url.' . $key, '');
    }
}