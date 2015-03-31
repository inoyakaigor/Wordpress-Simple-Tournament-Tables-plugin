<?php
/*
Plugin Name: tournamenttable
Plugin URI: http://inoyakaigor.ru
Description: Позволяет создавать турнирные таблицы
Version: 1.0
Author: Игорь Звягинцев
Author URI: http://inoyakaigor.ru
License: GPL3
*/

function create_tournament_table_menu(){
  add_menu_page('Добавить турнирную таблицу', 'Турнирные таблицы', 'export', 'tournament-tables', 'tournamenttableoptions');
}

add_action('admin_menu', 'create_tournament_table_menu');

function tournamenttableoptions(){
  echo "<h1>Редактор турнирных таблиц</h1>";
  require_once("markup.php");
}

function add_tournament_table($atts){
  extract(shortcode_atts(array(
    tour => ""/*,
    tableno => ""*/
  ), $atts));
  if(is_single()){
    require_once "functions.php";
    $tt = new TT($db);

    $tours = $tt->getTournaments();

    //$card = '<h4>Турнирная таблица</h4>';
    $card = "<table class='tournament-table main-color-font'>";
    $card .= "<tr><td><div>Название</div><td>И<td>В<td>Н<td>П<td>М<td>О<!--td>%-->";
    /*if (!empty($tableno)) {
      $t = $tt->getTeamsByTournament($tour, $tableno);
    } else {
    }*/
      $t = $tt->getTeamsByTournament($tour);

    foreach ($t as $key => $value) {
      $card .= "<tr><td><div><a href='";
      $card .= $value["teamlink"];
      $card .= "'>";
      $card .= $value["team"];
      $card .= "</a></div><td>";
      $card .= $value["i"];
      $card .= "<td>";
      $card .= $value["v"];
      $card .= "<td>";
      $card .= $value["n"];
      $card .= "<td>";
      $card .= $value["p"];
      $card .= "<td>";
      $card .= $value["m"];
      $card .= "<td>";
      $card .= $value["o"];
    //  $card .= "<td>";
    //  $card .= $value["prcnt"];
    }
    $card .= "</table>";
  }
  //$tt = NULL;
  return $card;
}
add_shortcode("tour", "add_tournament_table");