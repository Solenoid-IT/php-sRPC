<?php



namespace Solenoid\sRPC;



class Action
{
    public Error|null $error = null;

    public string $endpoint;
    public string $class;
    public string $method;



    public function __construct (public string $route)
    {
        // (Getting the values)
        [ $endpoint, $action ] = explode( '?m=', $route, 2 );

        if ( !isset( $action ) )
        {// Value not found
            // (Getting the value)
            $this->error = new Error( 400, 'sRPC :: ACTION_NOT_SET' );

            // Returning the value
            return;
        }



        // (Getting the values)
        [ $class, $method ] = explode( '.', $action, 2 );

        if ( !isset( $method ) )
        {// Value not found
            // (Getting the value)
            $this->error = new Error( 400, 'sRPC :: ACTION_NOT_VALID' );

            // Returning the value
            return;
        }



        // (Getting the value)
        $class = str_replace( '/', '\\', $class );

        if ( !class_exists( $class ) )
        {// (Class not found)
            // (Getting the value)
            $this->error = new Error( 404, 'sRPC :: CLASS_NOT_FOUND' );

            // Returning the value
            return;
        }



        if ( !method_exists( $class, $method ) )
        {// (Method not found)
            // (Getting the value)
            $this->error = new Error( 404, 'sRPC :: METHOD_NOT_FOUND' );

            // Returning the value
            return;
        }



        // (Getting the values)
        $this->endpoint = $endpoint;
        $this->class    = $class;
        $this->method   = $method;
    }



    public function __toString () : string
    {
        // Returning the value
        return $this->class . '.' . $this->method;
    }
}



?>