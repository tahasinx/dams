<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"]) && !isset($_SESSION["zone"])) {
    header("location:logout.php");
}


require_once './server/Partner.php';
$result = "";
$insert ="";

$server = new Partner();

$result = $server->partner_data();

if (isset($_POST['save'])) {
    $insert = $server->save_category($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
        <title>DAMS</title>
        <?php include './parts/css-links.php'; ?>
        <style>
            .content{
                font-family: 'Titillium Web', sans-serif;
            }
            form{
                font-size: 15px
            }
        </style>
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
                        <div class="col-sm-7 col-6">
                            <h4 class="page-title">Create Category&emsp;<?php echo $insert; ?></h4>
                        </div>

                        <div class="col-sm-5 col-6 text-right m-b-30">
                            <a href="manage-category.php" class="btn btn-primary"><i class="fa fa-pencil"></i> Manage Category</a>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Category Name <span class="text-danger">*</span></label>
                                            <input class="form-control" placeholder="Example:Blood Tests" type="text" name="category_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Category Id <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="category_id" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Publication Status<span class="text-danger">*</span></label>
                                            <select class="form-control" type="text" name="status" required>
                                                <option value="" disabled selected>--select--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Category Description<span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="5" cols="30" name="description" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <center>
                                            <button class="btn btn-primary" type="submit" name="save">Save</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php include './parts/messages.php'; ?>
            </div>
        </div>
        <?php include './parts/js-links.php'; ?>

    </body>
</html>