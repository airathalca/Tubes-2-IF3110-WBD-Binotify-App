<?php

class LoggedException extends Exception
{
    public function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
        $this->logError($message, $code);
    }

    private function logError($message, $code)
    {
        error_log('[ERROR] ' . $code . ': ' . $message);
    }
}
