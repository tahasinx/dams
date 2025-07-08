<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

$admin_id = $_SESSION['admin_id'];

require_once './server/Admin.php';
$result = "";
$data = "";
$error = "";

$server = new Admin();
$result = $server->adminData();

$data = $server->verify_account();

if (isset($_POST['accept'])) {
    $error = $server->acceptAccount($_POST);
}

if (isset($_POST['cancel'])) {
    $error = $server->verificationFailed($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <?php include './parts/css-links.php'; ?>
        <style>
            .content{
                font-family: 'Titillium Web', sans-serif;
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
                    <?php
                    while ($row = $data->fetch_assoc()) {
                        $type = $row['verification_type'];
                        $partner_id = $row['partner_id'];
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="page-title"><u>Account Verification</u>&emsp;<?php echo $error; ?></h4>
                            </div>
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-primary btn-rounded float-right" onclick="window.open(this.href, 'popUpWindow', 'height=500,width=1000'); return false;">
                                    <i class="fa fa-search"></i>&nbsp;Check Profile Data
                                </a>
                            </div>
                        </div>
                        <form method="POST" action="">
                            <div class="row">

                                <div class="col-sm-6 card-box">
                                    <center>
                                        <h4 class="modal-title">TIN Certificate</h4>
                                        <div style="min-height: 400px;width: 300px;border:1px solid;border-radius: 5px">
                                            <img  alt="" style="height: 398px;width:297px " src="<?php echo substr($row['tin_certificate'],3)?>" onerror="this.onerror=null; this.src='../gallery/tin-example.jpg'"/>
                                        </div>
                                    </center>
                                </div>
                                <div class="col-sm-6 card-box">
                                    <center>
                                        <h4 class="modal-title">License Certificate</h4>
                                        <div style="min-height: 400px;width: 300px;border:1px solid;border-radius: 5px">
                                            <img alt="" style="height: 398px;width:297px " src="<?php echo substr($row['license_certificate'],3)?>" onerror="this.onerror=null; this.src='../gallery/license-example.jpg'"/>
                                        </div>
                                    </center>
                                </div>

                            </div>
                            <center>
                                <input type="submit" class="btn btn-primary btn-group-lg" name="accept"  value="Accept" />
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cancel&nbsp;</button>
                            </center>

                        </form>
                        <?php
                    }
                    ?>
                    <!--modal:cancel-->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 style="color:blue"><mark>Cancellation Cause<span class="text-danger">*</span></mark></h4>
                                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                                </div>
                                <form method="POST" action="">
                                    <input type="hidden" value="<?php echo $client_id; ?>" name="client_id" />
                                    <div class="modal-body" style="height: 150px">

                                        <input type="hidden" name="id" value="" />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-focus">
                                                    <textarea class="form-control floating" style="height:100px ;resize: none" cols="30" name="failed_cause" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row modal-footer">
                                        <div class="col-md-12">
                                            <center>
                                                <input type="submit" class="btn btn-danger" name="cancel" value="Cancel" style="width: 100%">
                                            </center>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
                <?php include './parts/messages.php'; ?>
            </div>
        </div>
        <?php include './parts/js-links.php'; ?>
        <script></script>

    </body>
</html>