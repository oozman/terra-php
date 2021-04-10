<?php

namespace Oozman\Terra\Contracts;

interface TerraContract
{
    /**
     * Get wallet info.
     *
     * @param   string  $accountAddress
     *
     * @return WalletContract
     */
    public function wallet(string $accountAddress): WalletContract;
}