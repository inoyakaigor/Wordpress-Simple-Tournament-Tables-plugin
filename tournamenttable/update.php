<?php
/*  ТОМУ, КТО ЭТО УВИДИТ!!
    ПОПЯЧЬСЯ ЮЗЕРНЕЙМ!
    НИЖЕ УВИДЕННОЕ МОЖЕТ ЛИШИТЬ ТЕБЯ РАССУДКА!!
    Я ПРЕДУПРЕДИЛ!1
    (да, я знаю, что это небезопасный говнокод, но писать проверки мне лень)
*/
require_once("functions.php");
$tt = new TT($db);

$id = (int) $_POST["id"];
$tournament = $_POST["tournament"];
$team       = $_POST["team"];
$teamlink   = $_POST["teamlink"];
$i          = $_POST["i"];
$v          = $_POST["v"];
$n          = $_POST["n"];
$p          = $_POST["p"];
$m          = $_POST["m"];
$o          = (int) $_POST["o"];
$order      = $_POST["order"];
echo $tt->update($id, $tournament, $team, $teamlink, $i, $v, $v, $n, $p, $m, $o, $order);