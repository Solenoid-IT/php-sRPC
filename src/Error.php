<?php



namespace Solenoid\sRPC;



class Error
{
    public function __construct (public int $http_code, public string $message) {}



    public function send () : void
    {
        // (Setting the code)
        http_response_code( $this->http_code );

        // (Setting the headers)
        header( 'Content-Type: text/plain' );
        header( 'sRPC-Error: 1' );

        // Printing the value
        echo $this->message;
    }
}



?>