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

$data = $server->verify_location();

if (isset($_POST['accept'])) {
    $error = $server->acceptLocation($_POST);
}

if (isset($_POST['cancel'])) {
    $error = $server->location_verification_Failed($_POST);
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

            form input{
                border: 1px solid !important
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
                                <h4 class="page-title"><u>Location Verification</u>&emsp;<?php echo $error; ?></h4>
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
                                        <h4>Searchable Name</h4>
                                        <input type="text" value="<?php echo $row['map_name']; ?>" name="map_name" class="form-control"/><br>
                                        <input type="submit" name="" value="CHECK" class="form-control btn btn-primary"/>
                                    </center>
                                    <br>
                                    <center>
                                        <h4>Map Position Info</h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Longitude</label>
                                                <input type="text" value="<?php echo $row['longitude']; ?>" name="longitude" class="form-control"/>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Latitude</label>
                                                <input type="text" value="<?php echo $row['latitude']; ?>" name="latitude" class="form-control"/>
                                            </div>

                                        </div>
                                        <br>
                                        <input type="submit" name="check" value="CHECK" class="form-control btn btn-primary"/>
                                        <br><br><br>
                                        <input type="submit" class="btn btn-success btn-group-lg" name="accept"  value="Accept" />
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cancel&nbsp;</button>

                                    </center>
                                </div>

                                <div class="col-sm-6 card-box" >
                                    <?php
                                    if (isset($_POST["map_name"])) {
                                        $address = $_POST["map_name"];
                                        $address = str_replace(" ", "+", $address);
                                        ?>

                                        <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>

                                        <?php
                                    } elseif (isset($_POST["check"])) {

                                        $latitude = $_POST["latitude"];
                                        $longitude = $_POST["longitude"];
                                        ?>

                                        <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>

                                        <?php
                                    }
                                    ?>
                                </div>


                            </div>

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