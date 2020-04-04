<?php


namespace Romanato\FlashingoMessage\Support;


trait ExceptionTrait
{
    protected $prefix = '<b>Flashingo:</b> ';

    protected function unknownType($message)
    {
        die($this->prefix . $message);
    }

    protected function sessionNotSet($message)
    {
        die($this->prefix . $message);
    }
}