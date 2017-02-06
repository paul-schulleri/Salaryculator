<?php
namespace Schulleri\Salaryculator\Core\Result;

/**
 * Class Success
 * Returns in case of success
 *
 * @package Schulleri\Salaryculator\Core\Result
 */
class Success extends Result
{
    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isFailure(): bool
    {
        return false;
    }
}
