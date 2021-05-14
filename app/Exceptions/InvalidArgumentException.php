<?php
namespace app\Exceptions;

class InvalidArgumentException extends BaseException
{
    public const INVALID_KEY = 'Given key is not valid.';

    public function displayErrorMessage(): string
    {
        // TODO: Implement displayErrorMessage() method.
    }
}