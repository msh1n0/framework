<?php

/**
 * Class UserDupeException
 */
class UserDupeException extends Exception{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
    }

    /**
     * @return string
     */
    public function __tostring(){
        return '## UserDupeException:'.$this->message.'##';
    }
}

/**
 * Class InputErrorException
 */
class InputErrorException extends Exception{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
    }

    /**
     * @return string
     */
    public function __tostring(){
        return '## UserDupeException:'.$this->message.'##';
    }
}