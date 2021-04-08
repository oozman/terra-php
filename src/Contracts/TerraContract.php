<?php

namespace Oozman\Terra\Contracts;

interface TerraContract
{
    /**
     * Get wallet info.
     *
     * @param   string  $mnemonicKey
     *
     * @return WalletContract
     */
    public function wallet(string $mnemonicKey): WalletContract;
}