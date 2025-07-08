<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"]) && !isset($_SESSION["zone"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$result = "";

$server = new Partner();
$server->notification_seen('message');
$result = $server->partner_data();
$messages = $server->received_messages();
if (isset($_POST['seen'])) {
    $server->mark_as_seen($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DAMS</title>
    <script src="../ckeditor/ckeditor.js"></script>
    <?php
    include './parts/css-links.php';
    ?>

</head>

<body>

<div class="main-wrapper">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <!--topnav-->
        <?php include './parts/top-nav.php'; ?>

        <!--sidenav-->
        <?php include './parts/side-nav.php'; ?>

    <?php } ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="row" style="font-family: 'Titillium Web', sans-serif;">
                <div class="col-sm-7 col-6">
                    <h4 class="page-title">
                        <u>Mails From People</u>
                    </h4>
                </div>
                <div class="col-sm-5 col-6 text-right m-b-30">

                    </a>
                </div>
            </div>
            <div class="row">
                <?php if ($messages->num_rows > 0) {
                    while ($row = $messages->fetch_assoc()) {
                        ?>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                            <div class="dash-widget">
                                <div style="padding: 3%">

                                    <?php if ($row['is_seen'] == 0) { ?>
                                        <form method="POST" action="">
                                            <input type="hidden" name="message_id" value="<?= $row['message_id'] ?>"/>
                                            <button type="submit" name="seen" class="btn btn-primary"
                                                    style="float: right">Make as
                                                read
                                            </button>
                                        </form>
                                    <?php } ?>
                                    <h3>
                                        Admin
                                        <?php if ($row['is_seen'] == 0) { ?>
                                            <i class="fa fa-check-circle text-danger"></i>
                                        <?php } else { ?>
                                            <i class="fa fa-check-circle text-success"></i>
                                        <?php } ?>
                                    </h3>
                                    <small><?= $row['sent_on'] ?></small><br><br>
                                    <p><?= $row['message_body'] ?></p>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="dash-widget">
                            <center>
                        <span class="text-danger">
                            No Data Found!
                        </span>
                            </center>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>

        <!--scripts-->
        <?php include './parts/js-links.php'; ?>

</body>


</html>

