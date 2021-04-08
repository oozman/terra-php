<?php

namespace Oozman\Terra\Contracts;

interface WalletContract
{
    /**
     * Get account number.
     *
     * @return string
     */
    public function accountNo(): string;

    /**
     * Get UUSD.
     *
     * @return float
     */
    public function uusd(): float;

    /**
     * To array.
     *
     * @return array
     */
    public function toArray(): array;
}