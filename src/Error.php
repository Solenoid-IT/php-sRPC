<?php



namespace Solenoid\sRPC;



class Error
{
    public function __construct (public int $http_code, public string $message) {}



    public function send () : void
    {
        // (Setting the code)
        http_response_code( $this->http_code );

        // (Setting the header)
        header( 'Content-Type: text/plain' );

        // Printing the value
        echo $this->message;
    }
}



?>