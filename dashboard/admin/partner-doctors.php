<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './server/Admin.php';
$result = "";

$server = new Admin();
$result = $server->adminData();

$doctors = $server->view_doctors();
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
                    <h4 class="page-title"><u>Partners:</u> <span style="color:orangered"> Doctors</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <input id="myInput" type="text" placeholder="Search ...." list="type"
                                   style="height: 35px;width: 40%;border: 1px solid;text-align: center">
                            <datalist id="type">
                                <?php include "../doctor-types.php"; ?>
                            </datalist>

                            <a href="" class="btn btn-outline-dark float-right">
                                <span style="color:orangered ">
                                    Total Labs: <?= $server->total_doctors() ?>
                                </span>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody id="myTable">
                                    <?php
                                    if ($doctors->num_rows > 0) {
                                        while ($data = $doctors->fetch_assoc()) {
                                            ?>

                                            <tr>
                                                <td style="min-width: 200px;">
                                                    <a class="avatar">
                                                        <img src="<?= substr($data['institute_logo'], 3) ?>"
                                                             onerror="this.onerror=null; this.src='assets/img/user.jpg'">
                                                    </a>
                                                    <h2>
                                                        <a href=""><?= $data['doctor_title'] ?>
                                                            <span><?= $data['doctor_degree'] ?></span>
                                                        </a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Institute Name</h5>
                                                    <p><?= $data['institute_name'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Region</h5>
                                                    <p><?= $data['region'] . ',' . $data['city'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Joining Date</h5>
                                                    <p><?= $data['joining_date'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Profile Status</h5>
                                                    <p>
                                                        <?php if ($data['profile_status'] == 1) { ?>
                                                            <span class="text-success">Complete</span>
                                                        <?php } else { ?>
                                                            <span class="text-danger">Incomplete</span>
                                                        <?php } ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Account Status</h5>
                                                    <p>
                                                        <?php if ($data['account_status'] == 1) { ?>
                                                            <span class="text-success">Verified</span>
                                                        <?php } else { ?>
                                                            <span class="text-danger">Not Verified</span>
                                                        <?php } ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Status</h5>
                                                    <p>
                                                        <?php if ($data['status'] == 1) { ?>
                                                            <span class="text-success">Active</span>
                                                        <?php } else { ?>
                                                            <span class="text-danger">Inactive</span>
                                                        <?php } ?>
                                                    </p>
                                                </td>
                                                <td class="text-right">
                                                    <a href="partner-profile.php?partner_id=<?= $data['partner_id'] ?>&partnership_zone=<?= $data['partnership_zone'] ?>"
                                                       class="btn btn-outline-primary take-btn">Take
                                                        up</a>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8">
                                                <center>
                                                    <span class="text-danger">No Data Found</span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
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

</body>


</html>