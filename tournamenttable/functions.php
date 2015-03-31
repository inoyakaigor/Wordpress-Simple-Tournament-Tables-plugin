<?php
 //error_reporting(E_ALL);
 //ini_set('display_errors', 1);

$db = new PDO("mysql:host=mysqlserver;dbname=$dbname", $dbuser, $dbpass);

class TT {
public $db;

  function __construct($db) {
     $this->db = $db;
  }

  function addTeam($post){
    $tour = !empty($post["newtour"])?$post["newtour"]:$post["tour"];
    $sql = "insert into `tournaments`(`tournament`, `team`, `teamlink`,`i`,`v`,`n`,`p`,`m`,`o`,`order`) values('".$tour."', '".$post["team"]."', '".$post["teamlink"]."', '".$post["i"]."', '".$post["v"]."', '".$post["n"]."', '".$post["p"]."', '".$post["m"]."', ".$post["o"].", '".$post["order"]."')";
     // return $sql;
    return $this->db->query($sql)->rowCount();
  }

  function getTournaments(){
    $sql ="select distinct `tournament` from `tournaments` where 1 order by `order` asc";
    // var_dump($this->db);
    return $this->db->query($sql)->fetchAll(PDO::FETCH_COLUMN);
  }

  function getTeamsByTournament($tour/*, $order = 1*/){
    $tour = trim($tour);
    $sql = 'select * from `tournaments` where tournament like "'.$tour.'" order by `o` desc, `order` asc';
    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  function getAll(){
    $sql = 'select * from `tournaments` order by id asc';
    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  function delete($id){
    $sql = "delete from `tournaments` where `tournaments`.`id` = $id";
    return $this->db->query($sql)->rowCount();
  }

  function getId($id){
    $sql = "select * from `tournaments` where `id` = $id";
    $t = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($t[0]);
  }

  function update($id, $tournament, $team, $teamlink, $i, $v, $v, $n, $p, $m, $o, $order){
    $sql = "update `tournaments`
               set `tournament` = '$tournament',
                   `team`       = '$team',
                   `teamlink`   = '$teamlink',
                            `i` = '$i',
                            `v` = '$v',
                            `n` = '$n',
                            `p` = '$p',
                            `m` = '$m',
                            `o` = '$o',
                        `order` = '$order'
             where `tournaments`.`id` = $id";
    $count = $this->db->query($sql)->rowCount();
    if ($count > 0) {
      return "Обновлено ".$count." записей";
    } else {
      return "Что-то пошло не так! \n\n".$sql;
    }
    //return $this->db->query($sql)->rowCount();
  }
}
