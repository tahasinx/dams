<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"]) && !isset($_SESSION["zone"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';

$result = "";
$output = "";

$server = new Partner();

$result = $server->partner_data();

$data = $server->view_brunches();

if(isset($_POST['delete'])){
    $output = $server->remove_branch($_POST);
}

if(isset($_POST['update'])){
    $output = $server->update_branch_info($_POST);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DAMS</title>

    <?php
    include './parts/css-links.php';
    ?>

</head>

<body>

<div class="main-wrapper">
    <?php while ($row = $result->fetch_assoc()) {
        $profile_status = $row['profile_status']
        ?>
        <!--topnav-->
        <?php include './parts/top-nav.php'; ?>

        <!--sidenav-->
        <?php include './parts/side-nav.php'; ?>

    <?php } ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="page-title"><u>Branch List</u>&emsp;
                        <span class="text-success"><?= $output ?></span>
                    </h4>
                </div>
                <div class="col-sm-4">
                    <a href="branch-create.php" class="btn btn-primary btn-rounded float-right">
                        <i class="fa fa-plus-circle"></i>&nbsp;Add Branch
                    </a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <input id="myInput" type="text" placeholder="Search ...."
                                   style="height: 35px;width: 40%;border: 1px solid;text-align: center">
                            <a href="#" class="btn btn-outline-dark float-right">Total Branch:
                                <span style="color: orangered"><?= $server->total_branch() ?></span>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="d-none">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    <?php
                                    $i = 1;
                                    $x = 1;
                                    if ($data->num_rows > 0) {
                                        while ($row = $data->fetch_assoc()) {
                                            ?>

                                            <tr>
                                                <td>
                                                    <h5 class="time-title p-0">Branch Name</h5>
                                                    <p><?= $row['institute_name'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Country</h5>
                                                    <p><?= $row['country'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">City</h5>
                                                    <p><?= $row['city'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Region</h5>
                                                    <p><?= $row['region'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Address</h5>
                                                    <p><?= $row['address'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Status</h5>
                                                    <?php if ($row['status'] === '1') { ?>
                                                        <p class="text-success">Published</p>
                                                    <?php } else { ?>
                                                        <p class="text-danger">Unpublished</p>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-right">
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                        <a href="#modal<?= $i++ ?>"
                                                           class="btn btn-outline-primary take-btn" title="Update">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button type="submit" name="delete" onclick="return confirm('Are you really sure to remove?')"
                                                                class="btn btn-outline-danger take-btn" title="Remove">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <div class="awesome-modal" id="modal<?= $x++ ?>" style="height: 90%;overflow: auto">
                                                <div class="row">
                                                    <div class="col-lg-10 offset-lg-1">
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="serial_no" value="<?= $row['id'] ?>" />
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label>Country<span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="country" required >
                                                                        <option value="">Select</option>
                                                                        <option selected value="<?= $row['country'] ?>"><?= $row['country'] ?></option>
                                                                        <?php include '../../countries2.php'?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>City<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="city" value="<?= $row['city'] ?>" placeholder="Enter Drug Group" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Region<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="region" value="<?= $row['region'] ?>" placeholder="Enter Producer's Name" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Address<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="address" value="<?= $row['address'] ?>" placeholder="Enter Unit Price" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Contact No-1<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="contact_no1" value="<?= $row['contact_no1'] ?>" placeholder="Enter Contact No" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Contact No-2<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="contact_no2" value="<?= $row['contact_no2'] ?>" placeholder="Enter Contact No" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Contact No-3<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="contact_no3" value="<?= $row['contact_no3'] ?>" placeholder="Enter Contact No" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Hotline No<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="hotline_no" value="<?= $row['hotline_no'] ?>" placeholder="Enter Hotline No" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Emel Address<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="email" value="<?= $row['email'] ?>" placeholder="Enter Email Address" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Service Period<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="service_period" value="<?= $row['service_period'] ?>" placeholder="Enter Service Period" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Off Days<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="off_days" value="<?= $row['off_days'] ?>" placeholder="Enter Off Days" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Publication Status <span class="text-danger">*</span></label>
                                                                        <select class="form-control" name="status" required >
                                                                            <option value="">Select</option>
                                                                            <option value="1" <?php if($row['status'] === '1'){echo 'selected';} ?>>Published</option>
                                                                            <option value="0" <?php if($row['status'] === '0'){echo 'selected';} ?>>Unpublished</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12">
                                                                    <center>
                                                                        <button class="btn btn-primary" type="submit" name="update">Update &nbsp;
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                        <button class="btn btn-outline-danger" onclick="window.location.href='#close'">Cancel</button>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                    }else{ ?>
                                        <tr>
                                            <td colspan="">
                                                <center>
                                                   <span class="text-danger">
                                                       This repository is empty.
                                                   </span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'parts/notifications.php' ?>

    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>

<!--scripts-->
<?php include './parts/js-links.php'; ?>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>


</html>