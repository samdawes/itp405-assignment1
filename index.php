<?php
$pdo = new PDO('sqlite:chinook.db');
$sql = "SELECT * FROM genres";

$statement = $pdo->prepare($sql);
$statement->execute();

$genres = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  	<title>PDO</title>
  </head>
  <body>
    <table class="table">
      <tr>
  			<th>Genre</th>
  		</tr>
      <?php foreach ($genres as $genre): ?>
        <tr>
          <td>
            <a href="tracks.php?genre=<?php echo urlencode($genre->Name); ?>"><?php echo $genre->Name; ?></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html
