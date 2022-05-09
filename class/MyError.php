<?php

class MyError extends Exception{
    protected $message;
    protected $time;


    public function __construct($mes) {
        $this->message = $mes;
        $this->time = new DateTime();
    }

    public function getError() {
        $error['message'] = $this->message;
        $error['timeStamp'] = $this->time->format('Y-m-d H:i:s');
        return $error;
    }
}

?>