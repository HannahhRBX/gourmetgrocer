<?php 
    session_start(); 
    $title = 'Member Page'; 
    require __DIR__.'/./inc/header.php'; 
?>
<br>
<br>

<h1>Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>
<h4>Use the navigation bar or click <a href="./Inventory.php" class="link-primary">here</a> to browse products.</h4>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php require __DIR__.'/./inc/footer.php'; ?>