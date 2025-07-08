<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once 'server/Admin.php';
$result = "";
$message = "";

$server = new Admin();
$result = $server->adminData();


if (isset($_POST['create'])) {
    $message = $server->create_post($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="../ckeditor/ckeditor.js"></script>
    <?php
    include './parts/css-links.php';
    ?>
    <style>
        form, h4 {
            font-family: 'Ubuntu', sans-serif;
            font-size: 15px;
        }

    </style>
</head>

<body>

<div class="main-wrapper">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="header">
            <?php include './parts/top-nav.php'; ?>
        </div>

        <div class="sidebar" id="sidebar">
            <?php include './parts/side-nav.php'; ?>
        </div>
    <?php } ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <form method="post" enctype="multipart/form-data" autocomplete="nope">
                        <div class="form-group">
                            <label>Post Title<span style="color:red">*</span> &emsp;<h3 class="text-success"><?php echo $message; ?></h3></label>
                            <input type="text" class="form-control" name="post_title" placeholder="" required="">
                        </div>
                        <div class="form-group">
                            <label>Post Description<span style="color:red">*</span></label>
                            <textarea name="post_description" id="editor1" required></textarea>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                        </div>
                        <div class="form-group">
                            <label>Post For<span style="color:red">*</span></label>
                            <select type="text" class="form-control" name="posted_for">
                                <option value="">Select</option>
                                <option value="clients">Clients</option>
                                <option value="doctors">Doctors</option>
                                <option value="labs">Labs</option>
                                <option value="pharmacies">Pharmacies</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Publication Status<span style="color:red">*</span></label>
                            <select type="text" class="form-control" name="publication_status" required>
                                <option value="">Select</option>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                        <div>
                            <input type="submit" value="CREATE" name="create" class="btn btn-lg btn-dark"
                                   style="height: 50px;width: 100%">
                        </div>
                    </form>

                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <?php include './parts/messages.php'; ?>
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>

<!--scripts-->
<?php include './parts/js-links.php'; ?>

</body>


</html>