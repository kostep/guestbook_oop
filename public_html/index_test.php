<?php
include_once('header.html');

include_once(dirname(__FILE__).'\..\sys\core\init.inc.php');

$guestbook= new GuestBook($dbo);



$special_array=$guestbook->show_entries('ASC', 'username', '3');


foreach($special_array as $key=>$value)
{

}


//var_dump($guestbook);



echo'
    <div id="upper">

        <div class="entry_container">
            <div class="entry_left">
                <p class="username"><span class="username_title">Автор: </span>Иванов Иван Иванович</p>
                <p class="email"><span class="email_title">Почта: </span>email@test.com</p>
                <p class="site"><span class="site_title">Сайт: </span><a href="http://yandex.ru">http://yandex.ru</a></p>
                <p class="entry_date"><span class="entry_date_title">Отправлено: </span>31.12.2018</p>
            </div>
            <div class="entry_right">
                <p class="entry_text_title">Сообщение:</p> <p class="entry_text"> Привет, - я Иванов Иван Иванович. <br> Привет ещё раз, -- я Иванов Иван Иванович</p>
            </div>
        </div>
        <div class="entry_container">
            <div class="entry_left">
                <p class="username"><span class="username_title">Автор: </span>Иванов Иван Иванович</p>
                <p class="email"><span class="email_title">Почта: </span>email@test.com</p>
                <p class="site"><span class="site_title">Сайт: </span><a href="http://yandex.ru">http://yandex.ru</a></p>
                <p class="entry_date"><span class="entry_date_title">Отправлено: </span>31.12.2018</p>
            </div>
            <div class="entry_right">
                <p class="entry_text_title">Сообщение:</p> <p class="entry_text"> Привет, - я Иванов Иван Иванович. <br> Привет ещё раз, -- я Иванов Иван Иванович</p>
            </div>
        </div>
        <div class="entry_container">
            <div class="entry_left">
                <p class="username"><span class="username_title">Автор: </span>Иванов Иван Иванович</p>
                <p class="email"><span class="email_title">Почта: </span>email@test.com</p>
                <p class="site"><span class="site_title">Сайт: </span><a href="http://yandex.ru">http://yandex.ru</a></p>
                <p class="entry_date"><span class="entry_date_title">Отправлено: </span>31.12.2018</p>
            </div>
            <div class="entry_right">
                <p class="entry_text_title">Сообщение:</p> <p class="entry_text"> Привет, - я Иванов Иван Иванович. <br> Привет ещё раз, -- я Иванов Иван Иванович</p>
            </div>
        </div>
        <div class="entry_container">
            <div class="entry_left">
                <p class="username"><span class="username_title">Автор: </span>Иванов Иван Иванович</p>
                <p class="email"><span class="email_title">Почта: </span>email@test.com</p>
                <p class="site"><span class="site_title">Сайт: </span><a href="http://yandex.ru">http://yandex.ru</a></p>
                <p class="entry_date"><span class="entry_date_title">Отправлено: </span>31.12.2018</p>
            </div>
            <div class="entry_right">
                <p class="entry_text_title">Сообщение:</p> <p class="entry_text"> Привет, - я Иванов Иван Иванович. <br> Привет ещё раз, -- я Иванов Иван Иванович</p>
            </div>
        </div>
        <div class="entry_container">
            <div class="entry_left">
                <p class="username"><span class="username_title">Автор: </span>Иванов Иван Иванович</p>
                <p class="email"><span class="email_title">Почта: </span>email@test.com</p>
                <p class="site"><span class="site_title">Сайт: </span><a href="http://yandex.ru">http://yandex.ru</a></p>
                <p class="entry_date"><span class="entry_date_title">Отправлено: </span>31.12.2018</p>
            </div>
            <div class="entry_right">
                <p class="entry_text_title">Сообщение:</p> <p class="entry_text"> Привет, - я Иванов Иван Иванович. <br> Привет ещё раз, -- я Иванов Иван Иванович</p>
            </div>
        </div>


        <p class="links">
            <a href="index.php">убыв</a>| дата |<a href="index.php">возр</a>
            <a href="index.php">убыв</a>| имя |<a href="index.php">возр</a>
            <a href="index.php">убыв</a>| email |<a href="index.php">возр</a>
            </br></br>
            <a href="index.php"> <-- предыдущая страница </a> ||<a href="index.php">  следующая страница --> </a>
        </p>
    </div>
 <!--
    <div id="under">
        <div id="error_box">
        <span class="error_text">
            Ошибка,раз! <br>
            Ошибка, два!<br>
            Ошибка, три! <br>
            Ошибка, четыре!<br>
            Ошибка, пять!<br>
        </span>
        </div>

        <div id="form_entry">
            <form class="form_one">
            <div class="form_inner_box">
                <div class="form_left_box"><span class="form_title">Введите имя/псевдоним<span class="red_color">*</span>:</span></div>
                <div class="form_right_box"><input type="text" size="40" maxlength="100"></input></div>
            </div>
            <div class="form_inner_box">
                <div class="form_left_box"><span class="form_title">Введите email<span class="red_color">*</span>:</span></div>
                <div class="form_right_box"><input type="text" size="40" maxlength="100"></input></div>
            </div>
            <div class="form_inner_box">
                <div class="form_left_box"><span class="form_title">Введите Ваш сайт:</span></div>
                <div class="form_right_box"><input type="text" size="40" maxlength="100"></input></div>
            </div>
            <div class="form_inner_textarea_box">
                <div class="form_left_box"><span class="form_title">Введите текст сообщения<span class="red_color">*</span>:</span></div>
                <div class="form_textarea_box"><textarea style="width: 80%; height: 80%; resize: none;"></textarea></div>
            </div>
            <div class="form_inner_box">
                <div class="form_left_box"><span class="form_title">Введите каптчу<span class="red_color">*</span>:</span></div>
                <div class="form_captcha_text_box"><input type="text" size="20" maxlength="20"></input></div>
                <div class="form_captcha_image_box"><img src="captcha.php"></div>
            </div>
            <div class="form_inner_box">
                <div class="form_button_box"><button  class="button_style_1" type="submit">Отправить сообщение</button></div>
            </div>
            </form>
        </div>

    </div>
 -->
';


include_once('footer.html');
