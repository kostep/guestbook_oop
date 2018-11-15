<?php

// This if(!function_exists('__autoload')) is needed for test purposes. Testing each class separately, when init.inc.php
// is not included.

if(!function_exists('__autoload'))
{
    function __autoload($class)
    {

        $filename=dirname(__FILE__).'\..\class\class.'.$class.'.inc.php';

        if(file_exists($filename))
        {
            include_once($filename);
        }
    }
}



/**
 * Class GuestBook . Literally(ha-ha) ;) my main class.  Allows to show and edit my site's guestbook
 *
 * @author Stephan aka Loremaster
 * @copyright  Stephan aka Loremaster 2018
 * @license  GNU PL
 */


class GuestBook extends DbConnect {

    // well, here i have THE QUESTION
    // what is better for class design either to instantiate property for each string in database entry,
    // property for  database entry or property for the object that consists all entries from database request.
    // probably while educating and this is test work i have to create all three?
    // or maybe last two
    // OR it should be array of already fetched entries from query, not object but array


    /**
     *  Property that stores one guestbook's entry
     *
     * @var array Array of strings wich consists 4 strings
     *
     */
    protected $first_entry;

    /**
     * Property that stores total object wich is total query from database
     * Query of selection all our guestbook entries
     *
     * @var object A database object
     */
    protected $entries_query_result;

    /**
     * Property that stores an array of already fetched entries from database query
     * Query of selection all our guestbook entries
     *
     * @var array An array (associated?)
     */
    public $entries_query_fetch;

    /**
     * Property, that stores whitelist of sorting types
     *
     * @var array An array
     *
     */
    private $sort_type_whitelist;

    /**
     * Property, that stores whiteles of sorting order
     *
     * @var array An array
     */
    private $sort_order_whitelist;

    /**
     * Property> that stores sorting order for SQL request
     *
     * @var string A string
     */
    public $sort_order;

    /**
     * Property> that stores sorting type for SQL request
     *
     * @var string A string
     */
    public $sort_type;

    /**
     * Property, that stores total amount of entries in guestbook_entry table
     *
     * @var integer An integer
     */
    public $total_count;

    /**
     * Property, that consists of entries i show on current page
     *
     * @var array An array of arrays
     */
    private $page_array;

    /**
     * Property, that shows what is the current page of guestbook user are on
     *
     * @var integer An integer
     */
    public $current_page;

    /**
     * Property, that shows what is the current offset for database query
     *
     * @var ineger An integer
     */
    public $current_offset;

    /**
     * Property that saves error mesage from entry form to show it on sitepage
     * @var string A string
     */
    public $entry_form_errors;


    /**
     *
     * This method takes database object
     *
     * @param object $db A database object
     */
    public function __construct($db = NULL, $sort= NULL)
    {
        parent::__construct($db);

        // Defining values for whitelist for sorting type
        $this->sort_type_whitelist=array(

            0=>'username',
            1=>'email',
            2=>'time_and_date'

        );

        // Defining values for whitelist for sorting order
        $this->sort_order_whitelist=array(
            0=>'DESC',
            1=>'ASC'
        );

        // Defining default value for $current_page
        $this->sort_order='DESC';

        // Defining default value for $sort_type
        $this->sort_type='time_and_date';

        // Defining default value for $current_page
        $this->current_page='0';

        // Defining default error message
        $this->entry_form_errors='';


        // Defining total amount of entries in database table guestbook_entry
        $this->total_count=$db->query('SELECT count(*) FROM guestbook_entries')->fetchColumn(0);



        //$this->first_entry=$db->query('SELECT * FROM guestbook_entry WHERE id=1')->fetchColumn(2);
       //  $this->entries_query_result=$db->query('SELECT * FROM guestbook_entry')->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * This method adds new entry to the database
     *
     * @param array $entry
     */
    public function add_entry($entry=NULL)
    {

    }

    /**
     *
     * This method shows list of entries on site's page depending on input parameters
     *
     * @param
     */
    public function show_entries($sort_order=NULL, $sort_type=NULL, $current_page_from_outside=NULL)
    {
        //Sanitizing data
        $current_page_from_outside=intval($current_page_from_outside);
        if ($current_page_from_outside<=0)
        {
            $this->current_page=0;
            $this->current_offset=0;
        }
        // Generaly this is extra, made because of probably error if you have no entries in your base and forced with "ungood" page manually from ?get
        // Instead of this you may use this condition inside elsif and make the
        // elseif body same as above: $this->current_page=0; $this->current_offset=0;
        elseif(($current_page_from_outside*ENTRIES_ON_PAGE)>$this->total_count)
        {

            if($this->total_count<=ENTRIES_ON_PAGE)
            {
                $this->current_offset=0;
                $this->current_page=0;
            }
            else
            {
                $this->current_offset=($this->total_count-ENTRIES_ON_PAGE+1);
                $this->current_page=intval(($this->total_count)/ENTRIES_ON_PAGE);
                echo $this->current_page;
            }
        }
        else
        {
            $this->current_page=$current_page_from_outside;
            $this->current_offset=$current_page_from_outside*ENTRIES_ON_PAGE;
        }

        // Whitlisting sorting order
        // sort_order can be strictly either DESC (default) or ASC
        if($sort_order!='ASC')
        {
            $this->sort_order='DESC';
        }
        else
        {
            $this->sort_order='ASC';
        }

        // Whitelisting sorting type. It is already set by default like $this->sort_type='username'
        // So if there is no coincidence between $value and outer data it will be still 'username'
        foreach($this->sort_type_whitelist as $key=>$value)
        {
            if($sort_type==$value)
            {
                $this->sort_type=$value;
            }
        }
        // Making database request to get fields for entries to show on page. Fetching it into ASSOC array after.
        // And assigning result to $this->page_array
        $this->page_array=$this->db->
        query('SELECT username, email, homesite, time_and_date, text FROM guestbook_entries  ORDER BY '.$this->sort_type.' '.$this->sort_order.'  LIMIT '.$this->current_offset.' , '.ENTRIES_ON_PAGE)->fetchAll(PDO::FETCH_ASSOC);

        return $this->page_array;
    }
    /**
     *
     * This shows entry input form, makes error_check and send data to database
     *
     * @param
     */
    public function entry_form()
    {
        $html='
        <div id="form_entry">
            <form class="form_one" action="index.php" method="post">
            <div class="form_inner_box">
                <div class="form_left_box"><span class="form_title">Введите имя/псевдоним<span class="red_color">*</span>:</span></div>
                <div class="form_right_box"><input name="username" type="text" size="40" maxlength="100"></input></div>
            </div>
            <div class="form_inner_box">
                <div class="form_left_box"><span class="form_title">Введите email<span class="red_color">*</span>:</span></div>
                <div class="form_right_box"><input name="email" type="text" size="40" maxlength="100"></input></div>
            </div>
            <div class="form_inner_box">
                <div class="form_left_box"><span class="form_title">Введите Ваш сайт:</span></div>
                <div class="form_right_box"><input name="homesite" type="text" size="40" maxlength="100"></input></div>
            </div>
            <div class="form_inner_textarea_box">
                <div class="form_left_box"><span class="form_title">Введите текст сообщения<span class="red_color">*</span>:</span></div>
                <div class="form_textarea_box"><textarea name="text" style="width: 80%; height: 80%; resize: none;"></textarea></div>
            </div>
            <div class="form_inner_box">
                <div class="form_left_box"><span class="form_title">Введите каптчу<span class="red_color">*</span>:</span></div>
                <div class="form_captcha_text_box"><input name="captcha" type="text" size="20" maxlength="20"></input></div>
                <div class="form_captcha_image_box"><img src="captcha.php"></div>
            </div>
            <div class="form_inner_box">
                <div class="form_button_box"><button  class="button_style_1" type="submit">Отправить сообщение</button></div>
            </div>
            </form>
        </div>';

        return $html;
    }
}