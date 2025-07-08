<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$result = "";
$data = "";
$testName = "";

$server = new Partner();
$result = $server->partner_data();

$message = "";
$data = $server->available_tests();
$testName = $server->available_tests();

if (isset($_POST['change'])) {
    $server->update_test_status($_POST);
}
if (isset($_POST['delete'])) {
    $server->delete_test($_POST);
}

$i = 1;
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
    <style>
        table {
            text-align: center !important;
            font-family: 'Titillium Web', sans-serif !important;
        }

        th {
            background-color: #333333;
            color: white
        }

        input,
        button {
            text-align: center;
            font-family: 'Titillium Web', sans-serif !important;
        }

        input[type="submit"] {
            width: 100%
        }

        h4 {
            font-family: 'Titillium Web', sans-serif !important;
        }

        h4 mark {
            color: blue
        }
    </style>

</head>

<body>

    <div class="main-wrapper">
        <?php
        while ($row = $result->fetch_assoc()) {

            $profile_status = $row['profile_status'];
            $premium_status = $row['premium_status'];
        ?>
            <!--topnav-->
            <?php include './parts/top-nav.php'; ?>

            <!--sidenav-->
            <?php include './parts/side-nav.php'; ?>

        <?php } ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8 col-6">
                        <h4 class="page-title"><b><u>REPOSITORY</u></b><?php echo $message; ?></h4>
                    </div>

                    <div class="col-sm-4 col-6 text-right m-b-30">
                        <a href="select-category.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>Create New</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">AVAILABLE TESTS&nbsp;[ <span style="color:orangered"><?php echo $server->total_available_tests() ?></span> ]</h4>
                                <input class="float-right" id="myInput" list="id" placeholder="Search...." />
                                <datalist id="id">
                                    <?php
                                    while ($row = $testName->fetch_assoc()) {
                                    ?>
                                        <option><?php echo $row['test_name'] ?></option>
                                    <?php } ?>
                                </datalist>
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
                                            if ($data->num_rows > 0) {
                                                while ($row = $data->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <h5 class="time-title p-0">Serial No</h5>
                                                            <p><?php echo $i++; ?></p>
                                                        </td>
                                                        <td>
                                                            <h5 class="time-title p-0">Category Name</h5>
                                                            <p><?php echo $row['category_name'] ?></p>
                                                        </td>
                                                        <td>
                                                            <h5 class="time-title p-0">Test Name</h5>
                                                            <p><?php echo $row['test_name'] ?></p>
                                                        </td>
                                                        <td>
                                                            <h5 class="time-title p-0">Status</h5>
                                                            <p><?php if ($row['status'] == 0) { ?>
                                                                    <span class="text-danger">Unoublished</span>
                                                                <?php } else { ?>
                                                                    <span class="text-success">Published</span>
                                                                <?php } ?></p>
                                                        </td>
                                                        <td class="text-right">
                                                            <form method="POST">
                                                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
                                                                <?php if ($row['status'] == 1) { ?>
                                                                    <input type="hidden" name="status" value="0" />
                                                                    <button type="submit" title="Click to unpublish" name="change" class="btn btn-danger take-btn"><i class="fa fa-ban"></i></button>
                                                                <?php } else { ?>
                                                                    <input type="hidden" name="status" value="1" />
                                                                    <button type="submit" title="Click to publish" name="change" class="btn btn-success take-btn"><i class="fa fa-check"></i></button>
                                                                <?php } ?>
                                                                <button type="submit" title="Delete" name="delete" class="btn btn-danger take-btn" onclick="return confirm('Are you sure to delete?');"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="4">
                                                        <span style="color:red;text-align: center">No Data Found !</span>
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
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <?php include './parts/messages.php'; ?>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!--scripts-->
    <?php include './parts/js-links.php'; ?>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>