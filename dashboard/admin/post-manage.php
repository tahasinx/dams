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

$posts = $server->view_posts();

if (isset($_POST['send'])) {
    $output = $server->send_message($_POST);
}
if (isset($_POST['delete'])) {
    $output = $server->delete_post($_POST);
}
if (isset($_POST['published']) || isset($_POST['unpublished'])) {
    $output = $server->change_post_status($_POST);
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
                        <u>Posts</u>
                    </h4>
                </div>
                <div class="col-sm-5 col-6 text-right m-b-30">

                    </a>
                </div>
            </div>
            <div class="row">
                <?php if ($posts->num_rows > 0) {
                    while ($row = $posts->fetch_assoc()) {
                        ?>

                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                            <div class="dash-widget">
                                <div style="padding: 3%">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h3>
                                                <?= $row['post_title'] ?>
                                                <?php if ($row['publication_status'] == 1) { ?>
                                                    <i class="fa fa-check-circle text-success"></i>

                                                <?php } else { ?>
                                                    <i class="fa fa-check-circle text-danger"></i>
                                                <?php } ?>
                                            </h3>
                                        </div>
                                        <div class="col-sm-3">
                                            <form method="POST" action="">
                                                <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>"/>
                                               <?php if ($row['publication_status'] == 1) { ?>
                                                   <input type="hidden" name="publication_status" value="0"/>
                                                   <button type="submit" name="unpublished" class="btn btn-outline-dark" title="Mark as unpublished."><i class="fa fa-lock"></i></button>
                                                <?php } else { ?>
                                                   <input type="hidden" name="publication_status" value="1"/>
                                                   <button type="submit" name="published" class="btn btn-outline-primary" title="Mark as published."><i class="fa fa-unlock"></i></button>
                                                <?php } ?>
                                                <button type="submit" name="delete" class="btn btn-outline-danger"  title="Delete" onclick="return confirm('Are you sure to delete? ')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <?= $row['post_description'] ?>
                                    <br>
                                    <br>
                                    <table>
                                        <tr>
                                            <td style="color:blueviolet">Posted By:</td>
                                            <td><?= $row['posted_by'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="color:blueviolet">Posted For:</td>
                                            <td><?= $row['posted_for'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="color:blueviolet">Posted On:</td>
                                            <td><?= $row['posted_on'] ?></td>
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

