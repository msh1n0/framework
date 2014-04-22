<?php

/**
 * Class UserDupeException
 */
class ElementDupeException extends Exception{
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
        return '## ElementDupeException:'.$this->message.'##';
    }
}

/**
 * Class DirectoryNotFoundException
 */
class DirectoryNotFoundException extends Exception{
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
        return '## DirectoryNotFoundException:'.$this->message.'##';
    }
}
/**
 * Class TemplateNotFoundException
 */
class TemplateNotFoundException extends Exception{
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
        return '## TemplateNotFoundException:'.$this->message.'##';
    }
}
/**
 * Class ConfigurationException
 */
class ConfigurationException extends Exception{
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
        return '## ConfigurationException:'.$this->message.'##';
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
        return '## InputErrorException:'.$this->message.'##';
    }
}