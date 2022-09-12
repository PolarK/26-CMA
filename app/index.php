<?php
include('./src/template/header.php');

if (isset($_SESSION['available'])) {
    include('./src/template/navbar.php');
}

?>

<div id="content" class="container-fluid p-5">

    <?php
    switch ($_GET['page']) {
        case 'register':
            include('./src/pages/register.php');
            break;

        case 'login':
            include('./src/pages/login.php');
            break;
        
        default:
            if (isset($_SESSION['available'])) {
                include('./src/pages/dashboard.php');
            } else {
                include('./src/pages/login.php');
            }
            break;
    }
    ?>

</div>

<?php include('./src/template/footer.php'); ?>