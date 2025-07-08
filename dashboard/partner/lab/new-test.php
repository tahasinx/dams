<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './server/Admin.php';
$result = "";
$insert ="";
$categoryData = "";

$server = new Admin();
$result = $server->adminData();
$categoryData = $server->active_category();

if (isset($_POST['save'])) {
    $insert = $server->save_test_data($_POST);
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
                    <div class="row">
                        <div class="col-sm-7 col-6">
                            <h4 class="page-title">Create Test&emsp;<?php echo $insert ?></h4>
                        </div>

                        <div class="col-sm-5 col-6 text-right m-b-30">
                            <a href="test-repository.php" class="btn btn-primary"><i class="fa fa-book"></i>&nbsp;Repository</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Test Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="test_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Test ID <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="test_id" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Test Category<span class="text-danger">*</span></label>
                                            <select class="form-control" type="text" name="category_id" required>
                                                <option value="" disabled selected>--select--</option>
                                                <?php
                                                while ($row = $categoryData->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Test Description<span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="5" cols="30" name="description" id="editor1" required></textarea>
                                            <script>
                                                CKEDITOR.replace('editor1');
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Video Link</label>
                                            <input class="form-control" type="text" name="video_link" >
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
                                        <center>
                                            <button class="btn btn-primary" type="submit" name="save" style="width: 100%">Save</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>

        <!--scripts-->
        <?php include './parts/js-links.php'; ?>

    </body>


</html>