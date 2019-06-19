<?php
 include_once('../config/connect.php');

  $id = $_POST['id'];
  $page = $_POST['page'];
  $search = $_POST['search'];
  $mysql = "DELETE FROM guests WHERE id = ?";
  $query = $pdo->prepare($mysql);
  $query->execute([$id]);

  $nr_page = ($page*5)-5;

  $mysql = "SELECT * From guests WHERE name = ? OR surname = ?";
  $queries = $pdo->prepare($mysql);
  $queries->execute([$search,$search]);

  $data = $queries->fetchAll();
  echo json_encode($data);

?>
