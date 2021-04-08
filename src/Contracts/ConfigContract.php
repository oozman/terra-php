<?php

namespace Oozman\Terra\Contracts;

interface ConfigContract
{
    /**
     * Get environment.
     * Eg: testing, production.
     *
     * @return string
     */
    public function environment(): string;

    /**
     * Get baseUrl by key.
     *
     * @param   string|null  $key
     *
     * @return string
     */
    public function baseUrl(?string $key): string;
}