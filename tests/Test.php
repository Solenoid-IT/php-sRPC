<?php



use \Solenoid\sRPC\Action;



// (Getting the value)
$action = new Action( '/api/user?m=Home/Door.open' );

if ( $action->error )
{// (Error found)
    // (Sending the error)
    echo $action->error->send();
}



?>