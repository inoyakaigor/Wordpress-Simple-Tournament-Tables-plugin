<?php
/*  ТОМУ, КТО ЭТО УВИДИТ!!
    ПОПЯЧЬСЯ ЮЗЕРНЕЙМ!
    НИЖЕ УВИДЕННОЕ МОЖЕТ ЛИШИТЬ ТЕБЯ РАССУДКА!!
    Я ПРЕДУПРЕДИЛ!1
    (да, я знаю, что это небезопасный говнокод, но писать проверки мне лень)
*/
require_once("functions.php");
$tt = new TT($db);
echo $tt->addTeam($_POST);
