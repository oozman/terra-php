<?php

namespace Oozman\Terra\Entities;

use Exception;
use Illuminate\Support\Arr;
use JsonException;
use Oozman\Terra\Contracts\ConfigContract;
use Oozman\Terra\Contracts\TerraContract;
use Oozman\Terra\Contracts\WalletContract;
use Oozman\Terra\Exceptions\WalletException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Terra implements TerraContract
{
    protected ConfigContract $config;

    public function __construct(ConfigContract $config)
    {
        $this->config = $config;
    }

    /**
     * Get wallet details.
     *
     * @param   string  $accountAddress
     *
     * @return WalletContract
     * @throws WalletException
     */
    public function wallet(string $accountAddress): WalletContract
    {
        $process = new Process([$this->config->terraCLIPath(), 'wallet', $accountAddress]);

        $process->run();

        if ( ! $process->isSuccessful()) {
            throw new WalletException($process);
        }

        try {
            $process->mustRun();
            $result = json_decode($process->getOutput(), true, 512, JSON_THROW_ON_ERROR);

            return new Wallet($accountAddress, Arr::get($result, 'data'));
        } catch (ProcessFailedException $e) {
            throw new WalletException($e->getProcess()->getErrorOutput());
        } catch (JsonException $e) {
            throw new WalletException($process->getErrorOutput());
        } catch (Exception $e) {
            throw new WalletException($e->getMessage());
        }
    }
}