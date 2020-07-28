<?php

class CommandFileNotFoundException extends Exception
{
    /**
     * FileNotFoundException constructor.
     * @param $path
     */
    public function __construct(string $path)
    {
        parent::__construct();
        $this->message = "Command text file $path cannot be found.";
    }
}