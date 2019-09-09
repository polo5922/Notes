<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Notes - List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </head>
  <body>
    <style media="screen">
      .clickable-row{
        cursor: pointer;
      }
    </style>
    <!-- create a function to log to js console !-->
    <?php
    function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
            $output = implode( ',', $output);
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }



     ?>
    <!--create database if not exist !-->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS notes";
    if ($conn->query($sql) === TRUE) {
        debug_to_console("Database created successfully");
    } else {
        debug_to_console("Error creating database: " . $conn->error);
    }

    $conn->close();

     ?>
     <!-- Create all table if not exist !-->
     <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "notes";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS `student` (
	`id` int(10) NOT NULL auto_increment,
	`name` varchar(255),
	`sname` varchar(255),
	`class` varchar(255),
	PRIMARY KEY( `id` )
);";

      if ($conn->query($sql) === TRUE) {
          debug_to_console("Table student created successfully");
      } else {
          debug_to_console("Error creating table: " . $conn->error);
      }

      $sql = "CREATE TABLE IF NOT EXISTS `math` (
	`id` int(10) NOT NULL auto_increment,
	`id_student` numeric(9,2),
	`note` varchar(255),
	PRIMARY KEY( `id` )
);";

      if ($conn->query($sql) === TRUE) {
          debug_to_console("Table math created successfully");
      } else {
          debug_to_console("Error creating table: " . $conn->error);
      }

      $sql = "CREATE TABLE IF NOT EXISTS `PHP` (
	`id` int(10) NOT NULL auto_increment,
	`id_student` numeric(9,2),
	`note` varchar(255),
	PRIMARY KEY( `id` )
);";

      if ($conn->query($sql) === TRUE) {
          debug_to_console("Table PHP created successfully");
      } else {
          debug_to_console("Error creating table: " . $conn->error);
      }

      $sql = "CREATE TABLE IF NOT EXISTS `HTML` (
	`id` int(10) NOT NULL auto_increment,
	`id_student` numeric(9,2),
	`note` varchar(255),
	PRIMARY KEY( `id` )
);";

      if ($conn->query($sql) === TRUE) {
          debug_to_console("Table HTML created successfully");
      } else {
          debug_to_console("Error creating table: " . $conn->error);
      }

      $sql = "CREATE TABLE IF NOT EXISTS `c` (
	`id` int(10) NOT NULL auto_increment,
	`id_student` numeric(9,2),
	`note` varchar(255),
	PRIMARY KEY( `id` )
);";

      if ($conn->query($sql) === TRUE) {
          debug_to_console("Table C++ created successfully");
      } else {
          debug_to_console("Error creating table: " . $conn->error);
      }

      $sql = "CREATE TABLE IF NOT EXISTS `Python` (
	`id` int(10) NOT NULL auto_increment,
	`id_student` numeric(9,2),
	`note` varchar(255),
	PRIMARY KEY( `id` )
);";

      if ($conn->query($sql) === TRUE) {
          debug_to_console("Table Python created successfully");
      } else {
          debug_to_console("Error creating table: " . $conn->error);
      }

      echo "
      <table class='table'>
  <thead class='thead-dark'>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Name</th>
      <th scope='col'>Surname</th>
    </tr>
  </thead>
  <tbody>";

      $sql = "SELECT id, name, sname FROM student";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $name = ucfirst($row["name"]);
            $Sname = ucfirst($row["sname"]);
            echo "
            <tr class='clickable-row' data-href='detail.php?id={$row["id"]}'>
            <th scope='row'>{$row["id"]}</th>
            <td>{$name}</td>
            <td>{$Sname}</td>
            </tr>
            ";
          }
      } else {
          echo "0 results";
      }

      $conn->close();
      ?>
  </tbody>
</table>
<script type="text/javascript">
jQuery(document).ready(function($) {
  $(".clickable-row").click(function() {
    console.log($(this).data("href"));
      window.location = $(this).data("href");
  });
});
</script>
  </body>
</html>
