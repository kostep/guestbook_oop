<?php


/**
 * Class that connects us to the database
 *
 *
 * @author Stephan aka Loremaster
 * @copyright Stepahn aka Loremaster 2018
 * @license  GNU PL
 */


class DbConnect {
    /**
     * Property that stores database object
     * // @var type description
     *
     * @var object A database object
     *
     */
    protected $db;

    /**
     *
     * Method that checks database object or creates a new one if one is not found
     * // @param type  method parametr_name description
     *
     * @param object $db A database oject if it exists
     *
     */

    protected function __construct($db=NULL)
    {
        if (is_object($db))
        {
            $this->db=$db;
        }
        else
        {
            $dsn='mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CONN_CHARSET;
            try
            {
                $this->db= new PDO($dsn, DB_USER, DB_PASS);
            }
            catch( Exception $e)
            {
                die($e->getMessage());
            }



        }
}



}
