<?php



namespace Solenoid\sRPC;



class Procedure
{
    public string $endpoint;
    public string $procedure;

    public string $class;
    public string $method;

    public string $class_path;

    public Error|null $error = null;



    /**
     * Initializes a new instance of the Procedure class.
     * The constructor takes a request URI and an optional class prefix, and parses the URI to extract the endpoint, class, and method information. It also checks for the existence of the specified class and method, and sets an error if any of these are not found.
     * 
     * @param string $request_uri The request URI containing the procedure information.
     * @param string $class_prefix The prefix for the class path.
     */
    public function __construct (public string $request_uri, public string $class_prefix = '/App/Endpoints')
    {
        // (Getting the values)
        [ $endpoint, $procedure ] = explode( '?p=', $request_uri, 2 );

        if ( !isset( $procedure ) || empty( $procedure ) )
        {// Value not found
            // (Getting the value)
            $this->error = new Error( 400, 'sRPC :: Missing Procedure Selector' );

            // Returning the value
            return;
        }



        // (Getting the values)
        [ $class, $method ] = explode( '.', $procedure, 2 );

        if ( !isset( $method ) || empty( $method ) )
        {// Value not found
            // (Getting the value)
            $this->error = new Error( 400, 'sRPC :: Missing Procedure Selector' );

            // Returning the value
            return;
        }



        // (Getting the value)
        $class_path = str_replace( '/', '\\', "$class_prefix/$class" );

        if ( !class_exists( $class_path ) )
        {// (Class not found)
            // (Getting the value)
            $this->error = new Error( 404, 'sRPC :: Procedure Not Found' );

            // Returning the value
            return;
        }



        if ( !method_exists( $class_path, $method ) )
        {// (Method not found)
            // (Getting the value)
            $this->error = new Error( 404, 'sRPC :: Procedure Not Found' );

            // Returning the value
            return;
        }



        // (Getting the values)
        $this->endpoint   = $endpoint;
        $this->procedure  = $procedure;
        $this->class      = $class;
        $this->method     = $method;
        $this->class_path = $class_path;
    }



    /**
     * Returns the string representation of the procedure in the format "Class.Method".
      *
      * @return string The string representation of the procedure.
     */
    public function __toString () : string
    {
        // Returning the value
        return $this->class . '.' . $this->method;
    }



    /**
     * Gets the protocol error, if any.
      *
      * @return Error|null The protocol error, or null if no error is present.
     */
    public function get_protocol_error () : Error|null
    {
        // Returning the value
        return $this->error;
    }
}



?>