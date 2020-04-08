<?php


namespace Romanato\FlashingoMessage\Support;


class Exception extends \Exception
{
    protected $prefix = '<b>Flashingo:</b> ';

    public function unknownType()
    {
        die($this->prefix . $this->getMessage());
    }

    public function sessionNotSet()
    {
        die($this->prefix . $this->getMessage());
    }
}