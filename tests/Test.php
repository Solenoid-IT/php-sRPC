<?php



// (Including files)
include_once( __DIR__ . '/../vendor/autoload.php' );
include_once( __DIR__ . '/app/Endpoints/Public/Auth/User.php' );



use \Solenoid\sRPC\Procedure;



// (Getting the value)
$procedure = new Procedure( '/api/public?p=Auth/User.login', '/App/Endpoints/Public' );



// (Getting the value)
$protocol_error = $procedure->get_protocol_error();

if ( $protocol_error )
{// (Error found)
    // (Sending the error)
    $protocol_error->send();
}
else
{// (No error found)
    // Printing the value
    print_r( $procedure );
}



?>