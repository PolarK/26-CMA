<?php 

    // works only on pdf files 
    
    require "./classes/dbAPI.class.php";

    $db = new Database(); 
    
    if (isset($_GET["filepath"])) {
        $filepath = "./src/pages/submitter/submissions/" . $_SESSION["UID"] . "/" . $_GET["filepath"]; 
    }    
   
?>

<div>
    <iframe src= "<?php echo $filepath; ?>" frameborder="1" width="90%" height="500px"></iframe>
</div>
