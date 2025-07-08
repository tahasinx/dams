<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$output = "";

$server = new Home();

$data = $server->client_profile();
$result = $server->appointments();

if (isset($_POST['delete'])) {
    $output = $server->delete_appointment($_POST);
}

if (isset($_POST['change'])) {
    $output = $server->update_login_data($_POST);
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include './parts/css-links.php'; ?>
    <style>
        form,table,h1,h3{
            font-family: 'Titillium Web', sans-serif;
        }
        table{
            font-size: 15px
        }

    </style>
</head>

<body>
<header>
    <?php include './parts/header.php'; ?>
</header>
<!-- // Header  -->
<br>
<br>
<br>
<div id="page-title" class="padding-tb-30px gradient-white">
    <div class="container">
        <h1 class="font-weight-300" style="text-transform: uppercase;margin-left: -20px"><u>My Dashboard</u></h1>
        <h1 style="color:green"></h1>
    </div>
</div>


<div class="margin-tb-30px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <table>
                        <h3>Profile Data</h3>
                        <?php while ($row = $data->fetch_assoc()) { ?>
                            <tr>
                                <td>Name</td>
                                <td><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td><?php echo $row['contact'] ?></td>
                            </tr>
                            <tr>
                                <td>Joining Date</td>
                                <td><?php echo $row['joining_date'] ?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><?php echo $row['username'] ?></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><?php echo $row['password'] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <form method="POST" action="">
                        <table>
                            <h3>Change Login Data</h3>
                            <tr>
                                <td>New Username</td>
                                <td><input name="username"  style="width:100%" required/></td>
                            </tr>
                            <tr>
                                <td>New Password</td>
                                <td><input name="password" style="width:100%" required/></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="Change" name="change" class="btn btn-dark" style="width:100%"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-7">

                <table>
                    <h3>Appointments</h3>
                    <tr>
                        <th>Serial</th>
                        <th>Institute Name</th>
                        <th>Test Name</th>
                        <th>Test Price</th>
                        <th>Requested Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $i = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $server->name_by_id($row['request_to']) ?></td>
                                <td><?php echo $server->testName_byID($row['requested_test']) ?></td>
                                <td><?php echo $row['test_price'] ?></td>
                                <td><?php echo $row['requested_date'] ?></td>
                                <td>
                                    <?php
                                    if ($row['request_status'] == 1) {
                                        echo '<span style="color:blueviolet">Pending</span>';
                                    } elseif ($row['status'] == 1) {
                                        echo '<span style="color:green">Accepted</span> [ <a href="invoice.php?appointmnet_id='.$row['appointmnet_id'].'" target="_blank">token</a> ]';
                                    } elseif ($row['is_cancelled'] == 1) {
                                        echo '<span style="color:red">Cancelled</span>';
                                    }
                                    ?>

                                </td>
                                <td>
                                    <center>
                                        <form method="POST" action="">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                            <button class="btn btn-danger" type="submit" title="delete" name="delete" style="cursor: pointer" onclick="return confirm('Are sure to delete?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </center>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {

                    }
                    ?>
                </table>

            </div>
        </div>
    </div>
</div>

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

<!--footer-->
<?php include './parts/footer.php'; ?>

<!--scripts-->
<?php include './parts/js-links.php'; ?>
</body>
</html>
