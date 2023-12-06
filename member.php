<?php 
    session_start(); 
    require_once __DIR__.'/./inc/functions.php';
    
    //if (!isset($_SESSION['user']))
   // {
    //    redirect('login', ["error" => "You need to be logged in to view this page"]);
   // }
   //echo var_dump($_SESSION);
    $title = 'Member Page'; 
    require __DIR__.'/./inc/header.php'; 
?>

<h1>Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>

<?php require __DIR__.'/./inc/footer.php'; ?>