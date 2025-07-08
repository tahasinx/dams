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

$emails = $server->view_emails();

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
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Compose &emsp;<span class="text-success"><?php if (isset($_GET['message'])) {
                                echo $_GET['message'];
                            } ?></span></h4>
                </div>
            </div>
            <div class="row">
                <?php if ($emails->num_rows > 0) {
                    while ($data = $emails->fetch_assoc()) {
                        ?>

                        <div class="col-sm-6">
                            <div class="dash-widget">
                                <table>
                                    <tr style="height: 50px">
                                        <td>Mailed To:</td>
                                        <td style="color:blue">
                                            <a href="partner-profile.php?partner_id=<?= $data['email_to'] ?>"
                                               class="">Profile</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>To:</td>
                                        <td style="color: blueviolet"><?= $data['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cc:</td>
                                        <td style="color: blueviolet"><?= $data['cc'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Bcc:</td>
                                        <td style="color: blueviolet"><?= $data['bcc'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sent On:</td>
                                        <td style="color:red"> <?= $data['sent_on'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="height:20px"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <?= $data['message'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-sm-12">
                        <div class="dash-widget">
                            <center>
                                <h3 class="text-danger">No Email Found!</h3>
                            </center>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>

<!--scripts-->
<?php include './parts/js-links.php'; ?>

</body>


</html>