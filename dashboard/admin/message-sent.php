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
$result = $server->adminData();

$messages = $server->view_messages();
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
                                    <p>"<?= $row['message_body'] ?>"</p>
                                    <br>
                                    <br>
                                    <table>
                                        <tr>
                                            <td style="color:blueviolet">Message For:</td>
                                            <td style="color:red"><?= $row['message_for'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="color:blueviolet">Message To:</td>
                                            <?php if ($row['message_for'] == 'partner') { ?>
                                                <td style="color:red">
                                                     <a href="partner-profile.php?partner_id=<?= $row['message_to'] ?>">Profile</a>
                                                </td>
                                            <?php } elseif ($row['message_for'] == 'client') { ?>
                                                <td style="color:red">
                                                    <a href="partner-profile.php?client_id=<?= $row['message_to'] ?>">Client</a>
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
                } ?>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>

        <!--scripts-->
        <?php include './parts/js-links.php'; ?>

</body>


</html>

