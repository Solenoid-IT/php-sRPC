<?php



namespace Solenoid\sRPC;



class Action
{
    public Error|null $error = null;

    public string $endpoint;

    public string $class;
    public string $method;

    public string $class_path;



    public function __construct (public string $request_path, public string $class_prefix = '/App/Endpoints')
    {
        // (Getting the values)
        [ $endpoint, $action ] = explode( '?m=', $request_path, 2 );

        if ( !isset( $action ) || empty( $action ) )
        {// Value not found
            // (Getting the value)
            $this->error = new Error( 400, 'sRPC :: ACTION NOT SET' );

            // Returning the value
            return;
        }



        // (Getting the values)
        [ $class, $method ] = explode( '.', $action, 2 );

        if ( !isset( $method ) || empty( $method ) )
        {// Value not found
            // (Getting the value)
            $this->error = new Error( 400, 'sRPC :: ACTION NOT VALID' );

            // Returning the value
            return;
        }



        // (Getting the value)
        $class_path = str_replace( '/', '\\', "$class_prefix/$class" );

        if ( !class_exists( $class_path ) )
        {// (Class not found)
            // (Getting the value)
            $this->error = new Error( 404, 'sRPC :: CLASS NOT FOUND' );

            // Returning the value
            return;
        }



        if ( !method_exists( $class_path, $method ) )
        {// (Method not found)
            // (Getting the value)
            $this->error = new Error( 404, 'sRPC :: METHOD NOT FOUND' );

            // Returning the value
            return;
        }



        // (Getting the values)
        $this->endpoint   = $endpoint;
        $this->class      = $class;
        $this->method     = $method;
        $this->class_path = $class_path;
    }



    public function __toString () : string
    {
        // Returning the value
        return $this->class . '.' . $this->method;
    }
}



?>