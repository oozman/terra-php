<?php

namespace Oozman\Terra\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface WalletContract extends Arrayable
{
    /**
     * Get account address.
     *
     * @return string
     */
    public function accAddress(): string;

    /**
     * Get UUSD.
     *
     * @return float
     */
    public function uusd(): float;

    /**
     * Get UKRW.
     *
     * @return float
     */
    public function ukrw(): float;
}