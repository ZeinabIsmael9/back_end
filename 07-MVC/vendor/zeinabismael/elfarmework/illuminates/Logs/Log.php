<?php

namespace Illuminates\Logs;

class Log extends \Exception
{
    protected $log_file;
    public function __construct($message, $code = 0, \Exception $previews = null, $log_file = "error.log")
    {
        parent::__construct($message, $code, $previews);
        $this->displayError();
        $this->log_file = $log_file;
        $this -> logError();
    }

    public function logError()
    {
        $logMessage = date('Y-m-d H:i:s') . " - Error {$this->getMessage()} in {$this->getFile()} on line {$this->getLine()}\n";
        // var_dump(storage_path('log/'. $this->log_file));
        file_put_contents(storage_path('log/'. $this->log_file), $logMessage, FILE_APPEND);
    }
    public  function displayError()
    {
        $message = $this->getMessage();
        $line = $this->getLine();
        $file = $this->getFile();
        $trace = $this->getTraceAsString();
        include base_path('app/views/errors/exception.tpl.php');
    }
}
