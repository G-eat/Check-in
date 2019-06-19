<?php
 include_once('../config/connect.php');

  $id = $_POST['id'];
  $page = $_POST['page'];
  $mysql = "DELETE FROM guests WHERE id = ?";
  $query = $pdo->prepare($mysql);
  $query->execute([$id]);

  $nr_page = ($page*5)-5;

  $mysql = "SELECT * From guests LIMIT $nr_page,5";
  $queries = $pdo->prepare($mysql);
  $queries->execute();

  $data = $queries->fetchAll();
  echo json_encode($data);

?>
