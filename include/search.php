<?php
  include_once('../config/connect.php');

  if (isset($_GET['search']) && isset($_GET['search']) != '' ) {
    $user = $_GET['search'];

    $mysql = "SELECT * FROM guests WHERE name = ? OR surname = ?";
    $query = $pdo->prepare($mysql);
    $query->execute([$user,$user]);

    $searchguests = $query->fetchAll();
  }

 ?>

  <!-- Search form -->
  <div class="container mt-5">
    <form method="get">
      <div class="md-form mt-0 d-flex flex-row">
        <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="search"  id='search'>
        <input type="submit" name="" value="Search" class="btn btn-info">
      </div>
    </form>
  </div>

  <?php if (isset($_GET['search']) && isset($_GET['search']) != '' && count($searchguests) >= 1){ ?>
    <div class="container mt-5" id ='a'>
      <ul class="list-group" id='ul'>
        <div class="row">
          <li class="list-group-item col-4 font-weight-bold">Name</li>
          <li class="list-group-item col-4 font-weight-bold">Surname</li>
          <li class="list-group-item col-4 font-weight-bold  text-center">Check-in</li>
          <?php foreach ($searchguests as $guest) { ?>
            <li class="list-group-item col-4"><?php echo $guest['name']; ?></li>
            <li class="list-group-item col-4"><?php echo $guest['surname']; ?></li>
            <li class="list-group-item col-4 text-center">
              <input type="checkbox"  id='checkbox' onclick="isCheck(<?php echo $guest['id']; ?>,<?php echo (isset($_GET['page']) ? $_GET['page']:'1')?>)">
            </li>
          <?php } ?>
        </div>
      </ul>
    </div>
    <div class="container mt-4">
      <a href="index.php">All Users</a>
    </div>
  <?php } elseif(isset($_GET['search'])  && count($searchguests) == 0) { ?>
    <div class="container mt-3">
      <h1 class="alert alert-warning">No guest with this name/surname.</h1>
      <a href="index.php">All Users</a>
    </div>
  <?php } ?>
