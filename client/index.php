<?php
  include_once('../config/connect.php');

  if (isset($_GET['page'])) {
    $pages = $_GET['page'];

    if ($pages == '' || $pages == '1') {
      $page = 0;
    } else {
      $page = ($pages*5)-5;
    }
  }else {
    $page = 0;
  }

  $mysql = "SELECT * FROM guests LIMIT $page,5";
  $query = $pdo->prepare($mysql);
  $query->execute();

  $guests = $query->fetchAll();


 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <title>Guest's</title>
   </head>
   <body>

     <!-- search -->
     <?php include_once('../include/search.php') ?>

     <?php if (empty($guests) ) { ?>
       <div class="container mt-5">
         <h1 class="alert alert-danger">No more guests in this page.</h1>
       </div>
     <?php } elseif(!(isset($_GET['search']) && isset($_GET['search']) != '')){ ?>
       <div class="container mt-5" id ='a'>
         <ul class="list-group" id='ul'>
           <div class="row">
             <li class="list-group-item col-4 font-weight-bold">Name</li>
             <li class="list-group-item col-4 font-weight-bold">Surname</li>
             <li class="list-group-item col-4 font-weight-bold  text-center">Check-in</li>
             <?php foreach ($guests as $guest) { ?>
               <li class="list-group-item col-4"><?php echo $guest['name']; ?></li>
               <li class="list-group-item col-4"><?php echo $guest['surname']; ?></li>
                <li class="list-group-item col-4 text-center">
                 <input type="checkbox"  id='checkbox' onclick="isCheck(<?php echo $guest['id']; ?>,<?php echo (isset($_GET['page']) ? $_GET['page']:'1')  ?>)">
               </li>
            <?php } ?>
           </div>
         </ul>
       </div>
     <?php }?>

     <?php if (!isset($_GET['search'])): ?>
       <div class="container mt-5">
         <?php
         // paginationo
         $mysqlpagination = "SELECT * FROM guests";
         $query = $pdo->prepare($mysqlpagination);
         $query->execute();

         $paginations = $query->rowCount();

         $a = $paginations/5;
         $a = ceil($a);
         if (!$a == 0) {
           for ($i=1; $i <= $a; $i++) { ?>
             <a href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a>
         <?php }
          } ?>
       </div>
     <?php endif; ?>


     <script src="../javascript/guests.js" charset="utf-8"></script>
   </body>
 </html>
