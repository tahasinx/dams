<?php
if (isset($_GET["institute_name"])) {
    $address = $_GET["institute_name"];
    $address = str_replace(" ", "+", $address);
    ?>

    <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>

    <?php
}
?>