<?php

namespace Oozman\Terra\Entities;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;
use Oozman\Terra\Contracts\WalletContract;

class Wallet implements WalletContract
{
    protected string $accountNo;
    protected Collection $balance;

    public function __construct(array $data)
    {
        $this->accountNo = Arr::get($data, 'address');
        $this->balance   = collect(Arr::get($data, 'balance'));
    }

    /**
     * Get account no.
     *
     * @return string
     */
    public function accountNo(): string
    {
        return $this->accountNo;
    }

    /**
     * Get uusd amount.
     *
     * @return float
     */
    public function uusd(): float
    {
        $uusd = $this->balance->where('denom', 'uusd')->first();

        if ( ! $uusd) {
            return 0.0;
        }

        return (float)Arr::get($uusd, 'amount');
    }

    /**
     * To array.
     *
     * @return array
     */
    #[ArrayShape(['account_no' => "string", 'uusd' => "float"])] public function toArray(): array
    {
        return [
            'account_no' => $this->accountNo(),
            'uusd'       => $this->uusd(),
        ];
    }
}