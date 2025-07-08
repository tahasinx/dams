<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './server/Admin.php';
$result = "";
$output = "";

$server = new Admin();
$server->notification_seen('message');
$result = $server->adminData();

$messages = $server->received_messages();
if (isset($_POST['seen'])) {
    $server->mark_as_seen($_POST);
}

if (isset($_POST['send'])) {
    $output = $server->send_message($_POST);
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
                        <u>Message Inbox</u>
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
                                    <p>"<?= $row['message_body'] ?>"</p>
                                    <br>
                                    <br>
                                    <table>
                                        <tr>
                                            <td style="color:blueviolet">Message From:</td>
                                            <?php if ($row['message_owner'] == 'partner') { ?>
                                                <td style="color:red">
                                                    <a href="partner-profile.php?partner_id=<?= $row['message_from'] ?>">Profile</a>
                                                </td>
                                            <?php } elseif ($row['message_owner'] == 'client') { ?>
                                                <td style="color:red">
                                                    <a href="partner-profile.php?client_id=<?= $row['message_from'] ?>">Client</a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td style="color:blueviolet">Sent On:</td>
                                            <td><?= $row['sent_on'] ?></td>
                                        </tr>
                                    </table>
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
    </div>
    <!--scripts-->
    <?php include './parts/js-links.php'; ?>

</div>
</body>


</html>

