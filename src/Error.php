<?php



namespace Solenoid\sRPC;



class Error
{
    public function __construct (public int $http_code, public string $message) {}    
}



?>