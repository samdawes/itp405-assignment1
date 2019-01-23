<?php
$pdo = new PDO('sqlite:chinook.db');
$sql = "
SELECT tracks.Name as TrackName, albums.Title, artists.Name as ArtistName, invoice_items.UnitPrice
FROM tracks
JOIN albums
ON tracks.AlbumId = albums.AlbumId
JOIN artists
ON albums.ArtistId = artists.ArtistId
JOIN invoice_items
ON tracks.TrackId = invoice_items.TrackId
JOIN genres
ON tracks.GenreId = genres.GenreId
";

if (isset($_GET['genre'])) {
  $sql = $sql . "WHERE genres.Name = ?;";
}

$statement = $pdo->prepare($sql);

if (isset($_GET['genre'])) {
  $statement->bindParam(1, $_GET['genre']);
}

$statement->execute();

$tracks = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  	<title>Results</title>
  </head>
  <body>
    <table class="table">
      <tr>
        <th>Track</th>
        <th>Album</th>
        <th>Artist</th>
        <th>Price</th>
      </tr>
      <?php foreach($tracks as $track): ?>
        <tr>
          <td>
            <?php echo $track->TrackName; ?>
          </td>
          <td>
            <?php echo $track->Title; ?>
          </td>
          <td>
            <?php echo $track->ArtistName; ?>
          </td>
          <td>
            <?php echo $track->UnitPrice; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>
