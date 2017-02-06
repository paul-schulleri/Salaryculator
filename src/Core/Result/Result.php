<?php
namespace Schulleri\Salaryculator\Core\Result;

/**
 * Class Result
 * @package Schulleri\Salaryculator\Core\Result
 */
abstract class Result
{
    /** @var */
    protected $body;

    /**
     * @param $body
     */
    public function __construct($body)
    {
        $this->body = $body;
    }

    /**
     * @param $value
     * @return Success
     */
    public static function success($value): Success
    {
        return new Success($value);
    }

    /**
     * @param $value
     * @return Failure
     */
    public static function failure($value): Failure
    {
        return new Failure($value);
    }

    /**
     * @return bool
     */
    abstract public function isSuccess(): bool;

    /**
     * @return bool
     */
    abstract public function isFailure(): bool;

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->body;
    }
}
