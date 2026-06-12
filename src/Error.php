<?php



namespace Solenoid\sRPC;



class Error
{
    public function __construct (public int $http_code, public string $message) {}



    public function send () : void
    {
        // (Setting the code)
        http_response_code( $this->http_code );



        // (Sending the header)
        header( 'Content-Type: text/plain' );

        if ( $this->http_code >= 400 )
        {// (Error found)
            // (Sending the header)
            header( 'sRPC-Error: ' . ( $this->http_code === 400 ? 2 : 3 ) );
        }



        // Printing the value
        echo $this->message;
    }
}



?>