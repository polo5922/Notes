<?php
$id = $_GET['id'];


 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>
    <style media="screen">
      #calc{
        cursor: pointer;
      }
    </style>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes";

function mysql_get_var($query,$y=0){
       $conn = mysqli_connect('localhost', 'root', '', 'notes');
       $res = $conn->query($query);
       $row = mysqli_fetch_array($res);
       mysqli_free_result($res);
       $rec = $row[$y];
       return $rec;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, name,sname FROM student WHERE id={$id}";
//echo $sql;
$result = $conn->query($sql);

if ($result->num_rows >= 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
        $Name = ucfirst($row["name"])." ". ucfirst($row["sname"]);
    }
} else {
    echo "0 results";
}
$math = mysql_get_var("SELECT note FROM math WHERE id_student={$id}");
$c = mysql_get_var("SELECT note FROM c WHERE id_student={$id}");
$html = mysql_get_var("SELECT note FROM html WHERE id_student={$id}");
$php = mysql_get_var("SELECT note FROM php WHERE id_student={$id}");
$python = mysql_get_var("SELECT note FROM python WHERE id_student={$id}");
//$Name = ucfirst($Name);
echo "
<title>Notes - {$Name}</title>
<br/>
<h1>{$Name}</h1>
<br/>
<table class='table'>
<thead class='thead-dark'>
<tr>
<th scope='col'>#</th>
<th scope='col'>Math</th>
<th scope='col'>C</th>
<th scope='col'>html</th>
<th scope='col'>php</th>
<th scope='col'>python</th>
<th scope='col' onclick='moyenne({$math},{$c},{$html},{$php},{$python});' id='calc'>calcul moyenne</th>
</tr>
</thead>
<tbody>";


echo "
<tr>
<th scope='row'>{$id}</th>
<td id='math'>{$math}</td>
<td id='c'>{$c}</td>
<td id='html'>{$html}</td>
<td id='php'>{$php}</td>
<td id='python'>{$python}</td>
<td id='moyenne_field'></td>
</tr>
";




$conn->close();
?>
<script type="text/javascript">
  function moyenne(math,c,html,php,python){
    //alert(math);
    var moyenne = (math + c + html + php + python) / 5;
    $("#moyenne_field").text(moyenne);
  }
</script>
  </body>
</html>
