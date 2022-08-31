<?php
include('./src/template/header.php');

if (isset($_SESSION['available'])) {
    include('./src/template/navbar.php');
}

?>

<div id="content" class="container-fluid p-5">

    <?php
    // check if session is set
    if (isset($_SESSION['available'])) {
        include('./src/pages/dashboard.php');
    } else {
        include('./src/pages/login.php');
    }
    ?>

</div>

<?php include('./src/template/footer.php'); ?>