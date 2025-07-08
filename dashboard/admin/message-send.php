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
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Send Message:
                        <?php if($_GET['for'] == 'partner'){?>
                            <a href="partner-profile.php?partner_id=<?= $_GET['partner_id'] ?>"
                            >Profile</a>
                        <?php }elseif ($_GET['for'] == 'client'){?>
                            <a href="client-profile.php?client_id=<?= $_GET['client_id'] ?>"
                            >Profile</a>
                            <?php
                        } ?>
                        &emsp;<span class="text-success"><?php if(isset($_GET['message'])){echo $_GET['message'];} ?></span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <form method="POST">
                            <?php if($_GET['for'] == 'partner'){?>
                                <input type="hidden" name="message_to" value="<?= $_GET['partner_id'] ?>">
                            <?php }elseif ($_GET['for'] == 'client'){?>
                                <input type="hidden" name="message_to" value="<?= $_GET['client_id'] ?>">
                                <?php
                            } ?>
                           <div class="form-group">
                                <textarea name="message_body" id="editor1" required></textarea>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                            <div class="form-group mb-0">
                                <div class="text-center compose-btn">
                                    <button type="submit" name="send" class="btn btn-primary"><span>Send</span> <i
                                            class="fa fa-send m-l-5"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
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