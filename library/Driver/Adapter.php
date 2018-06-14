<?php namespace PHPBook\SMS\Driver;

abstract class Adapter {
    
    public abstract function dispatch(\PHPBook\SMS\Message $message): Bool;

}