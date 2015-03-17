<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$db = new PDO("mysql:host=mysqlserver;dbname=litinsky_sport", "litinsky_sport", "67Vcs6Dh3f");

class TT {
public $db;

  function __construct($db) {
     $this->db = $db;
  }

  function addTeam($post){
    $tour = !empty($post["newtour"])?$post["newtour"]:$post["tour"];
    $sql = "insert into `tournaments`(`tournament`, `team`, `teamlink`,`i`,`v`,`n`,`p`,`m`,`o`) values('".$tour."', '".$post["team"]."', '".$post["teamlink"]."', '".$post["i"]."', '".$post["v"]."', '".$post["n"]."', '".$post["p"]."', '".$post["m"]."', ".$post["o"].")";
   // return $sql;
    return $this->db->query($sql)->rowCount();
  }

  function getTournaments(){
    $sql ="select distinct `tournament` from `tournaments` where 1";
    return $this->db->query($sql)->fetchAll(PDO::FETCH_COLUMN);
  }

  function getTeamsByTournament($tour){
    $sql = 'select * from `tournaments` where tournament like "'.$tour.'" order by `o` desc';
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

  function update($id, $tournament, $team, $teamlink, $i, $v, $v, $n, $p, $m, $o){
    $sql = "update `tournaments`
               set `tournament` = '$tournament',
                   `team`       = '$team',
                   `teamlink`   = '$teamlink',
                            `i` = '$i',
                            `v` = '$v',
                            `n` = '$n',
                            `p` = '$p',
                            `m` = '$m',
                            `o` = '$o'
             where `tournaments`.`id` = $id";
    return $this->db->query($sql)->rowCount();
  }
}
