<?php $title = 'Login Page'; require __DIR__ . "/inc/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 



if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $getInfo = urldecode($_SERVER['QUERY_STRING']);
    if ($getInfo != ''){
        // Display green status message if the word 'Success' is in the URL GET request
        ?>
        <div class="text-bg-success p-3">
            <div class="card bg-success text-center">
                <div class="card-body text-white"><h5>Your order number is #<?php echo $getInfo; ?> and has been processed successfully.</h5></div>
            </div>
        </div>
    <?php
    $_SESSION['user']['cart'] = array();
    }
}

require __DIR__ . "/inc/footer.php"; 
?>