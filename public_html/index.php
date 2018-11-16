<?php
include_once('header.html');

include_once(dirname(__FILE__).'\..\sys\core\init.inc.php');


if(!empty($_GET['current_page'])) {$current_page=$_GET['current_page'];} else {$current_page=0;}
if(!empty($_GET['sort_type'])) {$sort_type=$_GET['sort_type'];} else {$sort_type='time_and_date';}
if(!empty($_GET['sort_order'])) {$sort_order=$_GET['sort_order'];} else {$sort_order='DESC';}


$guestbook= new GuestBook($dbo);
$special_array=$guestbook->show_entries( $sort_order, $sort_type, $current_page );


echo'
    <div id="upper">
 ';

foreach($special_array as $key=>$value)
{
    echo'


        <div class="entry_container">
            <div class="entry_left">
                <p class="username"><span class="username_title">Автор: </span>'.$value['username'].'</p>
                <p class="email"><span class="email_title">Почта: </span>'.$value['email'].'</p>
                <p class="site"><span class="site_title">Сайт: </span><a href="http://yandex.ru">'.$value['homepage'].'</a></p>
                <p class="entry_date"><span class="entry_date_title">Отправлено: </span>'.$value['time_and_date'].'</p>
            </div>
            <div class="entry_right">
                <p class="entry_text_title">Сообщение:</p> <p class="entry_text">'.nl2br($value['text']).'</p>
            </div>
        </div>
';
}
echo'


        <p class="links">
            <a href="index.php?sort_order=DESC&sort_type=time_and_date&current_page='.$guestbook->current_page.'">убыв</a>| дата |<a href="index.php?sort_order=ASC&sort_type=time_and_date&current_page='.$guestbook->current_page.'">возр</a>
            <a href="index.php?sort_order=DESC&sort_type=username&current_page='.$guestbook->current_page.'">убыв</a>| имя |<a href="index.php?sort_order=ASC&sort_type=username&current_page='.$guestbook->current_page.'">возр</a>
            <a href="index.php?sort_order=DESC&sort_type=email&current_page='.$guestbook->current_page.'">убыв</a>| email |<a href="index.php?sort_order=ASC&sort_type=email&current_page='.$guestbook->current_page.'">возр</a>
            </br></br>
';
if(($guestbook->current_page-1)>=0)
{
    echo'   <a href="index.php?sort_order='.$sort_order.'&sort_type='.$sort_type.'&current_page='.($guestbook->current_page-1).'"> <-- предыдущая страница </a>
   ';
}
if((($guestbook->current_page-1)>=0)&&($guestbook->total_count/ENTRIES_ON_PAGE)>($guestbook->current_page))
{
    echo'       ||
';
}
{
    echo'   <a href="index.php?sort_order='.$sort_order.'&sort_type='.$sort_type.'&current_page='.($guestbook->current_page+1).'">  следующая страница --> </a>';
}

echo'       
        </p>
    </div>
';

echo'

    <div id="under">
        <div id="error_box">
        
        
        
        
        <span class="error_text">
        '.$guestbook->entry_form_errors.'
        <!--
            Ошибка,раз! <br>
            Ошибка, два!<br>
            Ошибка, три! <br>
            Ошибка, четыре!<br>
            Ошибка, пять!<br>
        !-->
        </span>
        
        </div>
';

echo $guestbook->entry_form($_POST);

echo'
    </div>

';


include_once('footer.html');
