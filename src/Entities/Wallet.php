<?php

namespace Oozman\Terra\Entities;

use Illuminate\Support\Arr;
use JetBrains\PhpStorm\ArrayShape;
use Oozman\Terra\Contracts\WalletContract;

class Wallet implements WalletContract
{
    protected string $accountAddress;
    protected array $balance;

    public function __construct(string $accountAddress, array $balance)
    {
        $this->accountAddress = $accountAddress;
        $this->balance        = $balance;
    }

    /**
     * Get account no.
     *
     * @return string
     */
    public function accAddress(): string
    {
        return $this->accountAddress;
    }

    /**
     * Get uusd amount.
     *
     * @return float
     */
    public function uusd(): float
    {
        return (float)Arr::get($this->balance, 'uusd');
    }

    /**
     * Get ukrw amount.
     *
     * @return float
     */
    public function ukrw(): float
    {
        return (float)Arr::get($this->balance, 'ukrw');
    }

    /**
     * To array.
     *
     * @return array
     */
    #[ArrayShape(['account_no' => "string", 'uusd' => "float", 'ukrw' => "float"])] public function toArray(): array
    {
        return [
            'account_no' => $this->accAddress(),
            'uusd'       => $this->uusd(),
            'ukrw'       => $this->ukrw(),
        ];
    }
}