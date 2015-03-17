<?php
  require "functions.php";
  $tt = new TT($db);
  $tours = $tt->getTournaments();
?>
<form id="addteamform" enctype="text/plain" accept-charset="utf-8">
<h3>Добавить команду в турнир
<select id="tour" name="tour">
  <?php
  foreach ($tours as $key => $value) {
    echo "<option value='".$value."'>".$value."</option>";

  }
  ?>
</select> или добавить в новый турнир <input type="text" id="newtour" name="newtour" placeholder="Название турнира">
</h3>
  <label>Название команды<br>
    <input type="text" id="team" name="team" placeholder="Название" required>
  </label>
  <label>Ссылка на страницу команды на сайте<br>
    <input type="text" id="teamlink" name="teamlink" placeholder="http://orelsport.ru/">
  </label>
  <label>И<br>
    <input type="text" id="i" name="i" placeholder="0" required>
  </label>
  <label>В<br>
    <input type="text" id="v" name="v" placeholder="0" required>
  </label>
  <label>Н<br>
    <input type="text" id="n" name="n" placeholder="0" required>
  </label>
  <label>П<br>
    <input type="text" id="p" name="p" placeholder="0" required>
  </label>
  <label>М<br>
    <input type="text" id="m" name="m" placeholder="0–0" required>
  </label>
  <label>О<br>
    <input type="text" id="o" name="o" placeholder="0" required>
  </label>
  <!--label>%<br>
    <input type="text" id="prcnt" name="prcnt" placeholder="00" required>
  </label-->
  <p class="btn-wrap"><input id="addteam" type="submit" value="Добавить" onclick="return false"></p>
</form>

<div class="list-view">
  <h3>Турниры таблицами</h3>
  <?php
    foreach ($tours as $key => $value) {
      echo "<h4> Турнир «".$value."»</h4>";
      echo "<table class='admin-table'>";
      echo "<tr><td>Команда<td>И<td>В<td>Н<td>П<td>М<td>О<!--td>%-->";
      foreach ($tt->getTeamsByTournament($value) as $key => $value) {
        echo "<tr><td>";
        echo $value["team"];
        echo "<td>";
        echo $value["i"];
        echo "<td>";
        echo $value["v"];
        echo "<td>";
        echo $value["n"];
        echo "<td>";
        echo $value["p"];
        echo "<td>";
        echo $value["m"];
        echo "<td>";
        echo $value["o"];
        echo "<!--td>";
        echo $value["prcnt"];
        echo "</td-->";
      }
      echo "</table>";
    }
  ?>
</div>

<div class="list-view">
  <h3>Команды и турниры списком</h3>
  <table class="admin-table">
  <tr><td>ID записи<td>Турнир<td>Команда<td>Ссылка на страницу команды<td>И<td>В<td>Н<td>П<td>М<td>О<!--td>%--><td>Удалить?
  <?php
  foreach ($tt->getAll() as $key => $value) {
        echo "<tr><td>";
        echo $value["id"];
        echo "<td>";
        echo $value["tournament"];
        echo "<td>";
        echo $value["team"];
        echo "<td><div>";
        echo $value["teamlink"];
        echo "</div><td>";
        echo $value["i"];
        echo "<td>";
        echo $value["v"];
        echo "<td>";
        echo $value["n"];
        echo "<td>";
        echo $value["p"];
        echo "<td>";
        echo $value["m"];
        echo "<td>";
        echo $value["o"];
        echo "<!--td>";
        echo $value["prcnt"];
        echo "--><td class='del-cross'>";
        echo "<span data-id=".$value["id"].">❌</span>";
  }
  ?>
  </table>
</div>
<div class="list-view">
  <h3>Редактирование записей</h3>
  <form>
    <table id="edittable">
      <tr><td style="text-align:right"><b>ID записи:</b><td><input type="text" name="id" id="id" value="88"><td><input type="button" id="getdata" value="Получить данные">
      <tr><td><input type="text" name="tournament" id="tournament" value="Чемпионат Ассоциации студенческого баскетбола (мужчины)">
          <td><input type="text" name="team" id="team" value="РИНХ (г.Ростов-на-Дону)">
          <td><input type="text" name="teamlink" id="teamlink" value="http://pro100basket.ru/season/team/info-719.html">
          <td><input type="text" name="i" id="i" value="0">
          <td><input type="text" name="v" id="v" value="0">
          <td><input type="text" name="n" id="n" value="0">
          <td><input type="text" name="p" id="p" value="0">
          <td><input type="text" name="m" id="m" value="0-0">
          <td><input type="text" name="o" id="o" value="0">
    </table>
<p class="btn-wrap"><input id="editbtn" type="submit" value="Обновить" onclick="return false"></p>
  </form>

</div>
<script type="text/javascript">
$("#addteam").on("click",function(){
   $.post(
        "/wp-content/plugins/tournamenttable/addteam.php",
        {
              tour: $("#tour").val(),
           newtour: $("#newtour").val(),
              team: $("#team").val(),
          teamlink: $("#teamlink").val(),
                 i: $("#i").val(),
                 v: $("#v").val(),
                 n: $("#n").val(),
                 p: $("#p").val(),
                 m: $("#m").val(),
                 o: $("#o").val()/*,
             prcnt: $("#prcnt").val()*/
        },
        onAjaxSuccess
    );
    return false;
});
function onAjaxSuccess(data){
    if(data == "1"){
      alert("Команда "+$("#team").val() + " успешно добавлена в турнир " + $("#tour").val());
    }else{
      alert(data);
    }
}

$("#tour").on("change", function(){ //очищаем поле нового турнира если выбрали турнир из списка
  $("#newtour").val("");
});

$(".list-view h3").on("click",function(){
    $(this).parent().toggleClass("show");
});

$(".del-cross > span").on("click",function(){
    $.get("/wp-content/plugins/tournamenttable/delete.php",
          { id: $(this).data("id")},
          onDelSuccess
         );
  $(this).parents("tr").remove();
});

function onDelSuccess(data){
    if(data == "1"){
      alert("Успешно удалено. Помянем †");
    }else{
      alert(data);
    }
}

$("#getdata").on("click",function(){
  $.getJSON("/wp-content/plugins/tournamenttable/getid.php",
          { id: $("#edittable #id").val()},
          onGetIdSuccess
         );
});
function onGetIdSuccess(data){
  $("#edittable #tournament").val(data.tournament);
  $("#edittable #team").val(data.team);
  $("#edittable #teamlink").val(data.teamlink);
  $("#edittable #i").val(data.i);
  $("#edittable #v").val(data.v);
  $("#edittable #n").val(data.n);
  $("#edittable #p").val(data.p);
  $("#edittable #m").val(data.m);
  $("#edittable #o").val(data.o);
}

$("#editbtn").on("click",function(){
   $.post(
        "/wp-content/plugins/tournamenttable/update.php",
        {
                id: $("#edittable #id").val(),
              tour: $("#edittable #tour").val(),
        tournament: $("#edittable #tournament").val(),
              team: $("#edittable #team").val(),
          teamlink: $("#edittable #teamlink").val(),
                 i: $("#edittable #i").val(),
                 v: $("#edittable #v").val(),
                 n: $("#edittable #n").val(),
                 p: $("#edittable #p").val(),
                 m: $("#edittable #m").val(),
                 o: $("#edittable #o").val()
        },
        onUpdSuccess
    );
    return false;
});
function onUpdSuccess(data){
    if(data == "1"){
      alert("Команда "+$("#team").val() + " успешно обновлена");
    }else{
      alert(data);
    }
}
</script>

<style>
.btn-wrap {
  width: 70%;
  text-align: right;
}
label {
  display: inline-block;
  text-align: center;
}
label:not(:first-of-type):not(:nth-of-type(2)) input {
  width: 30px;
}

#m {
  width: 60px;
}
.admin-table {
  border-collapse: collapse;
  border-spacing: 0;
  margin: 1em;
}
.admin-table tr:nth-of-type(1) {
  background: none repeat scroll 0 0 #ffffee;
  color: black;
  font-weight: bold;
}
.admin-table tr:hover {
  background-color: #eff;
}
.admin-table td {
  border: 1px solid grey;
  margin: 0;
  padding: 0.5em;
}
.list-view {
  height: 4em;
  overflow: hidden;
  transition: lenear 1s ease 0s;
}
.list-view.show {
  height: initial;
}
.list-view h3 {
  color: red;
  color: black;
  cursor: pointer;
  padding: 0.5em;
}
.list-view h3:hover {
  background-color: #ffc9c9;
}

.del-cross {
  text-align: center;
}

.del-cross > span {
  background-color: #ff5555;
  color: white;
  cursor: pointer;
  font-weight: bold;
  padding: 0.2em 0.5em;
}

.admin-table td:nth-of-type(4) div {
  word-break: break-all;
}

#i, #v, #n, #p, #m, #o {
  width: 5em;
}
</style>