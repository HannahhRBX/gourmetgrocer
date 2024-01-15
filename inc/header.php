<?php
require __DIR__.'/../inc/functions.php';
?>

<!doctype html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
 
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    


    <?php
    
    $userRole = RoutingController::verify_session_role();
    if ($userRole == 'admin' && !isset($loggedOut)){ // Nav bar for admins
    ?>
    <a class="navbar-brand" href="./AdminPanel.php">Gourmet Grocers</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Inventory
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="./Inventory.php">Manage Inventory</a></li>
            <li><a class="dropdown-item" href="./Categories.php">Manage Categories</a></li>
            <li><a class="dropdown-item" href="./Suppliers.php">Manage Suppliers</a></li>
            <li><a class="dropdown-item" href="./Restocks.php">View Restock Orders</a></li>
            <li><a class="dropdown-item" href="./Orders.php">View Customer Orders</a></li>
          </ul>
          
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Users
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" href="./Inventory.php">
            <li><a class="dropdown-item" href="./Users.php">Manage Users</a></li>
            <li><a class="dropdown-item" href="./Roles.php">Manage Roles</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./AdminPanel.php">Admin Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./login.php"><?php if (!isset($_SESSION['user'])){echo "Login";}else{echo "Logout";} ?></a>
        </li>
      </ul>
    </div>
    
    
    <div class="navbar-collapse collapse w-30 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="./Cart.php">View Order</a>
        </li>
      </ul>
    </div>
  <?php
  }elseif ($userRole != '' && !isset($loggedOut)){ // Nav bar non admin members
  ?>
  <a class="navbar-brand" href="./member.php">Gourmet Grocers</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./Inventory.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login.php"><?php if (!isset($_SESSION['user'])){echo "Login";}else{echo "Logout";} ?></a>
            
          </li>
        </ul>
      </ul>
    </div>
    
    
    <div class="navbar-collapse collapse w-30 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="./Cart.php">View Order</a>
        </li>
      </ul>
    </div>
  <?php
  }else{ // Nav bar not logged in:
  ?>
  <a class="navbar-brand" href="./login.php">Gourmet Grocers</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./login.php">Login</a>
        </li>
      </ul>
    </div>
    
    
  <?php
  }?>
  </nav>



  </body>
</html>