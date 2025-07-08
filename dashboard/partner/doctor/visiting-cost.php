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
$result2 = $server->partner_data();

$data = $server->view_brunches();

if (isset($_POST['delete'])) {
    $output = $server->remove_branch($_POST);
}

if (isset($_POST['update'])) {
    $output = $server->update_cost($_POST);
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
                    <h4 class="page-title"><u>Update Visiting Cost</u>&emsp;
                        <span class="text-success"><?= $output ?></span>
                    </h4>
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <input id="myInput" type="text" placeholder="Search ...."
                                   style="height: 35px;width: 40%;border: 1px solid;text-align: center">

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
                                    if ($result2->num_rows > 0) {
                                        while ($row = $result2->fetch_assoc()) {
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
                                                    <h5 class="time-title p-0">Status</h5>
                                                    <?php if ($row['status'] === '1') { ?>
                                                        <p class="text-success">Published</p>
                                                    <?php } else { ?>
                                                        <p class="text-danger">Unpublished</p>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="serial_no" value="<?= $row['id'] ?>">
                                                        <input type="hidden" name="type" value="main" >
                                                        <h5 class="time-title p-0">Visiting Cost [ BDT ]</h5>
                                                        <p><input type="" name="visit_price" class="text-center" value="<?= $row['visit_price'] ?>" required/>
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>"/>
                                                        <button name="update">Update</button></p>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
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
                                                    <h5 class="time-title p-0">Status</h5>
                                                    <?php if ($row['status'] === '1') { ?>
                                                        <p class="text-success">Published</p>
                                                    <?php } else { ?>
                                                        <p class="text-danger">Unpublished</p>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="type" value="branch" >
                                                        <h5 class="time-title p-0">Visiting Cost [ BDT ]</h5>
                                                        <p>
                                                            <input type="" name="visit_price" class="text-center" value="<?= $row['visit_price'] ?>" required/>
                                                            <input type="hidden" name="serial_no" value="<?= $row['id'] ?>"/>
                                                            <button name="update">Update</button>
                                                        </p>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
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