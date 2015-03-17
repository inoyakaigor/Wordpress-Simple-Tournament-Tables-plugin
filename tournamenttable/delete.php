<?php
require_once("functions.php");
$tt = new TT($db);
echo $tt->delete((int) $_GET['id']);