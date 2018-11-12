<?php
/*
 * Including database configuration info
 */

//define ('PATH', mb_substr($_SERVER["SCRIPT_FILENAME"], 0, mb_strrpos($_SERVER["SCRIPT_FILENAME"], "/")));


include_once(dirname(__FILE__).'\..\config\db_credits.inc.php');



/*
 * Defining database constants
 * $key  for example is DB_USER and $value accordingly is admin
 *
 */

foreach($c as $key=>$value)
{
    define($key,$value);
}

/**
 *  Defining the limit of entries on one page
 */
define('ENTRIES_ON_PAGE', 5);

/*
 * Creating PDO object
 *
 */

$dsn='mysql:host='.DB_HOST.'; dbname='.DB_NAME.';charset='.DB_CONN_CHARSET;
$dbo= new PDO($dsn, DB_USER, DB_PASS);



/*
 * Auto-load function for classes. (conventional way to load classes that were not in any case loaded manually)
 */

function __autoload($class)
{

    $filename=dirname(__FILE__).'\..\class\class.'.$class.'.inc.php';

    if(file_exists($filename))
    {
        include_once($filename);
    }
}