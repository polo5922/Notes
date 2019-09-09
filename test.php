<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Notes - List</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
  <style media="screen">
    .clickable{
      cursor: pointer;
    }
  </style>
  <?php
    try {
      // Connexion
      $db = new PDO('mysql:host=localhost;dbname=notes', 'root', '');
      //$db = new PDO('mysql:$host;$dbname', $login, $password);
      echo "<p>Connexion réussie.</p>\n";
      //récupération des information à imprimer et filtrage
      $dbl = "SELECT * FROM student";
      //Impression du tableau
      $res = $db->query($dbl);
       echo "<table>\n <caption>Liste des Etudiants</caption>\n";
       foreach ($res as $l)
       echo "<tr> <td>" . $l["id"] . "</td> <td>" . $l["name"] . "</td> <td>" . $l["sname"] . "</td> <td>" . $l["class"] ."</td> <td class='clickable' data-href='detail.php?id={$l["id"]}'><th scope='col'>{moyenne}</th></tr>\n";
       echo "</table>\n\n";
    } catch(PDOException $erreur) {
        echo "<p>Erreur : " . $erreur->getMessage() . "</p>\n";
    }
  ?>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".clickable").click(function() {
      console.log($(this).data("href"));
        window.location = $(this).data("href");
    });
  });
  </script>
</body>
