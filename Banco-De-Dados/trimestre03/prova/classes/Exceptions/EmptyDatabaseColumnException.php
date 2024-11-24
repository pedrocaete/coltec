<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

class EmptyDatabaseColumnException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
