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
        <br>
        <div class="row d-flex justify-content-center" style="width: 100%;">
            <div class="row d-flex justify-content-center " style="width: 40%;">
            <form action="./RestockDetails.php" method="get">
                <button class="btn btn-primary btn-lg w-80 mb-4" type="submit" id="AdminInventory">View Order</button>
                <input type="hidden" name="orderId" value="<?= $getInfo ?>">
            </form>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    <?php
    $_SESSION['user']['cart'] = array();
    }
}

require __DIR__ . "/inc/footer.php"; 
?>