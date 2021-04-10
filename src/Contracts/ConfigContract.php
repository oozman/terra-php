<?php

namespace Oozman\Terra\Contracts;

interface ConfigContract
{
    /**
     * Get LCD URL.
     *
     * @return string
     */
    public function lcdUrl(): string;

    /**
     * Get Chain ID.
     *
     * @return string
     */
    public function chainId(): string;

    /**
     * Get address provider id.
     *
     * @return string
     */
    public function addressProviderId(): string;

    /**
     * Get API URL.
     *
     * @return string
     */
    public function apiUrl(): string;

    /**
     * Get Terra CLI path.
     *
     * @return string
     */
    public function terraCLIPath(): string;
}