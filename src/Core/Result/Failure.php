<?php
namespace Schulleri\Salaryculator\Core\Result;

/**
 * Class Failure
 * Returns in case of failure
 *
 * @package Schulleri\Salaryculator\Commands\Core\Result
 */
class Failure extends Result
{
    /** @return bool */
    public function isSuccess(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isFailure(): bool
    {
        return true;
    }
}
