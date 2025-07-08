<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$output = "";

$server = new Home();
$server->notification_seen();

$data = $server->client_profile();
$test = $server->test_appointments();
$doctor = $server->doctor_appointments();
$orders = $server->orders();

$messages = $server->received_messages();

if (isset($_POST['delete'])) {
    $output = $server->delete_appointment($_POST);
}
if (isset($_POST['delete_order'])) {
    $output = $server->cancel_order($_POST);
}
if (isset($_POST['order_received'])) {
    $output = $server->mark_as_received($_POST);
}

if (isset($_POST['change_password'])) {
    $output = $server->update_login_data($_POST);
}
if (isset($_POST['change_picture'])) {
    $output = $server->update_propic($_POST);
}
if (isset($_POST['change_profile'])) {
    $output = $server->update_profile($_POST);
}
if (isset($_POST['seen'])) {
    $server->mark_as_seen($_POST);
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include './parts/css-links.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        form, table, h1, h3 {
            font-family: 'Titillium Web', sans-serif;
        }

        table {
            font-size: 15px
        }

        table tr td {

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
    <div class="container" style="min-height: 500px">
        <div class="row">
            <div class="col-sm-3">
                <div class="row">
                    <table>
                        <?php while ($row = $data->fetch_assoc()) {
                            $f_name = $row['first_name'];
                            $l_name = $row['last_name'];
                            ?>
                            <tr>
                                <td>
                                    <img src="<?= $propic = $row['propic'] ?>"
                                         onerror="this.onerror=null; this.src='assets/img/user.jpg'"
                                         style="height: 200px;width: 200px"/>
                                </td>
                            </tr>
                            <tr>
                                <td><b><?= $f_name . ' ' . $l_name ?></b></td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="color: orangered">Country:</span>&nbsp;<?= $country = $row['country'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">City:</span>&nbsp;<?= $city = $row['city'] ?></td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">Phone:</span>&nbsp;<?= $phone = $row['phone'] ?></td>
                            </tr>
                            <tr>
                                <td style="word-break: break-all;"><span
                                            style="color: orangered">Email:</span>&nbsp;<?= $email = $row['email'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="color: orangered">Address:</span>&nbsp;<?= $address = $row['address'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#modalx" class="btn btn-info" style="width:200px">Change
                                        Picture</a>
                                    <br>
                                    <a href="#modaly" class="btn btn-dark" style="width:200px;color: white">Update
                                        Profile</a>
                                    <br>
                                    <a href="#modalz" class="btn btn-primary" style="width:200px">Change
                                        Password</a>
                                </td>
                            </tr>
                            <div class="awesome-modal" id="modalx">
                                <a class="close-icon" href="#close"></a>
                                <center>
                                    <form method="post" enctype="multipart/form-data">
                                        <div style="border: 1px solid;height: 150px;width: 150px">
                                            <img id="blah" src="<?= $propic ?>" alt="your image"
                                                 onerror="this.onerror=null; this.src='assets/img/user.jpg'"
                                                 style="height: 150px;width: 150px"/>
                                        </div>
                                        <br>
                                        <input type="hidden" value="<?= $propic ?>" name="oldpic"/>
                                        <input type="file" name="propic" style="width: 160px"
                                               onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                        <br>
                                        <button name="change_picture" type="submit" class="btn btn-primary"
                                                style="width: 156px;cursor: pointer">Update
                                        </button>
                                    </form>
                                </center>
                            </div>
                            <div class="awesome-modal" id="modaly">
                                <a class="close-icon" href="#close"></a>
                                <br>
                                <br>
                                <center>
                                    <form method="POST">
                                        <input type="text" name="first_name" value="<?= $f_name; ?>"
                                               class="form-control"
                                               placeholder="Enter first name" required/><br>
                                        <input type="text" name="last_name" value="<?= $l_name; ?>" class="form-control"
                                               placeholder="Enter last name" required/><br>
                                        <input type="text" name="country" value="<?= $country; ?>" class="form-control"
                                               placeholder="Enter country name" required/><br>
                                        <input type="text" name="city" value="<?= $city; ?>" class="form-control"
                                               placeholder="Enter city name" required/><br>
                                        <input type="text" name="phone" value="<?= $phone; ?>" class="form-control"
                                               placeholder="Enter phone number" required/><br>
                                        <input type="text" name="email" value="<?= $email; ?>" class="form-control"
                                               placeholder="Enter email address" required/><br>
                                        <input type="text" name="address" value="<?= $address; ?>" class="form-control"
                                               placeholder="Enter address" required/><br>
                                        <button name="change_profile" type="submit" class="btn btn-primary"
                                                style="width: 100%;cursor: pointer">Change
                                        </button>
                                    </form>
                                </center>
                            </div>
                            <div class="awesome-modal" id="modalz">
                                <a class="close-icon" href="#close"></a>
                                <br>
                                <br>
                                <center>
                                    <form method="POST">
                                        <input type="text" name="username" class="form-control"
                                               placeholder="Enter Username"/><br>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Enter Password" autocomplete="new-password"/><br>
                                        <input type="password" name="confirm_password" class="form-control"
                                               placeholder="Confirm Password"/><br>
                                        <button name="change_password" type="submit" class="btn btn-primary"
                                                style="width: 100%;cursor: pointer">Change
                                        </button>
                                    </form>
                                </center>
                            </div>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="container">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#doctor" aria-controls="doctor" role="tab"
                                                                      data-toggle="tab">Doctor Appointments</a></li>
                            <li role="presentation"><a href="#lab" aria-controls="lab" role="tab"
                                                       data-toggle="tab">Lab Appointments</a></li>
                            <li role="presentation"><a href="#pharmacy" aria-controls="pharmacy" role="tab"
                                                       data-toggle="tab">Orders</a></li>
                            <li role="presentation"><a href="#message" aria-controls="message" role="tab"
                                                       data-toggle="tab">Messages</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="doctor">
                                <br>
                                <table style="width: 80%">
                                    <h3>Doctor Appointments</h3>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Institute Name</th>
                                        <th>Visiting Cost</th>
                                        <th>Appointment Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    if ($doctor->num_rows > 0) {
                                        while ($row = $doctor->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $server->name_by_id($row['request_to']) ?></td>
                                                <td><?php echo $row['visit_price'] ?></td>
                                                <td><?php echo $row['requested_date'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['request_status'] == 1) {
                                                        echo '<span style="color:blueviolet">Pending</span>';
                                                    } elseif ($row['status'] == 1) {
                                                        echo '<span style="color:green">Accepted</span> [ <a href="invoice.php?appointmnet_id=' . $row['appointmnet_id'] . '" target="_blank">token</a> ]';
                                                    } elseif ($row['is_cancelled'] == 1) {
                                                        echo '<span style="color:red">Cancelled</span>';
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <center>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="id"
                                                                   value="<?php echo $row['id']; ?>"/>
                                                            <button class="btn btn-danger" type="submit" title="delete"
                                                                    name="delete" style="cursor: pointer"
                                                                    onclick="return confirm('Are sure to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7">
                                                <center>
                                                    <span style="color:orangered">No appointment found!</span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </table>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="lab">
                                <br>
                                <table style="width: 80%">
                                    <h3>Lab Appointments</h3>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Doctor Name</th>
                                        <th>Test Name</th>
                                        <th>Test Price</th>
                                        <th>Requested Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $n = 1;
                                    if ($test->num_rows > 0) {
                                        while ($row = $test->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $n++; ?></td>
                                                <td><?php echo $server->name_by_id($row['request_to']) ?></td>
                                                <td>

                                                </td>
                                                <td><?php echo $row['test_name'] ?></td>
                                                <td><?php echo $row['test_price'] ?></td>
                                                <td><?php echo $row['requested_date'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['request_status'] == 1) {
                                                        echo '<span style="color:blueviolet">Pending</span>';
                                                    } elseif ($row['status'] == 1) {
                                                        echo '<span style="color:green">Accepted</span> [ <a href="invoice.php?appointmnet_id=' . $row['appointmnet_id'] . '" target="_blank">token</a> ]';
                                                    } elseif ($row['is_cancelled'] == 1) {
                                                        echo '<span style="color:red">Cancelled</span>';
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <center>
                                                        <?php  if ($row['status'] == 0) { ?>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="id"
                                                                   value="<?php echo $row['id']; ?>"/>
                                                            <button class="btn btn-danger" type="submit" title="delete"
                                                                    name="delete" style="cursor: pointer"
                                                                    onclick="return confirm('Are sure to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        <?php } ?>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7">
                                                <center>
                                                    <span style="color:orangered">No appointment found!</span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="pharmacy">
                                <br>
                                <table style="width: 80%">
                                    <h3>Drug Orders</h3>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Pharmacy Name</th>
                                        <th>Drug Name</th>
                                        <th>Order Quantity</th>
                                        <th>Total Cost</th>
                                        <th>Ordered On</th>
                                        <th>Delivered On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $m = 1;
                                    if ($orders->num_rows > 0) {
                                        while ($row = $orders->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $m++; ?></td>
                                                <td><?php echo $server->name_by_id($row['partner_id']) ?></td>
                                                <td><?php echo $row['drug_name'] ?>
                                                    <small><?php echo $row['drug_quantity'] ?></small></td>
                                                <td><?php echo $row['order_quantity'] ?></td>
                                                <td><?php echo $row['total_price'] ?> BDT</td>
                                                <td><?php echo $row['ordered_on'] ?></td>
                                                <td><?php echo $row['delivered_on'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['is_pending'] == 1) {
                                                        echo '<span style="color:blueviolet">Pending</span>';
                                                    } elseif ($row['is_processing'] == 1) {
                                                        echo '<span style="color:orangered">Processing</span>';
                                                    } elseif ($row['is_received'] == 1) {
                                                        echo '<span style="color:green">Received</span>';
                                                    } elseif ($row['is_delivered'] == 1) {
                                                        echo '<span style="color:green">Delivered</span>';
                                                    } elseif ($row['is_cancelled'] == 1) {
                                                        echo '<span style="color:red">Cancelled</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <center>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="id"
                                                                   value="<?php echo $row['id']; ?>"/>
                                                            <?php
                                                            if ($row['is_delivered'] == 1) { ?>
                                                                <button class="btn btn-outline-success" type="submit"
                                                                        title="mark as received."
                                                                        name="order_received" style="cursor: pointer">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                            <?php }
                                                            ?>
                                                            <?php
                                                            if ($row['is_delivered'] == 0 || $row['is_received'] == 0) {
                                                                if ($row['is_cancelled'] == 0) {
                                                                    ?>
                                                                    <button class="btn btn-outline-danger" type="submit"
                                                                            title="delete"
                                                                            name="delete_order" style="cursor: pointer"
                                                                            onclick="return confirm('Are sure to delete?');">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                <?php }
                                                            }
                                                            ?>
                                                        </form>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7">
                                                <center>
                                                    <span style="color:orangered">No appointment found!</span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="message">
                                <div class="row">
                                    <?php if ($messages->num_rows > 0) {
                                        while ($row = $messages->fetch_assoc()) {
                                            ?>
                                            <br>
                                            <div class="col-sm-4">
                                                <div class="card">
                                                    <div class="card-body" style="padding: 3%">

                                                        <?php if ($row['is_seen'] == 0) { ?>
                                                            <form method="POST" action="">
                                                                <input type="hidden" name="message_id"
                                                                       value="<?= $row['message_id'] ?>"/>
                                                                <button type="submit" name="seen"
                                                                        class="btn btn-primary"
                                                                        style="float: right">Make as
                                                                    read
                                                                </button>
                                                            </form>
                                                        <?php } ?>
                                                        <h3>
                                                            Admin
                                                            <?php if ($row['is_seen'] == 0) { ?>
                                                                <i class="fa fa-check-circle text-danger"></i>
                                                            <?php } else { ?>
                                                                <i class="fa fa-check-circle text-success"></i>
                                                            <?php } ?>
                                                        </h3>
                                                        <small><?= $row['sent_on'] ?></small><br><br>
                                                        <p><?= $row['message_body'] ?></p>
                                                        <br>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    } else { ?>
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                                            <div class="dash-widget">
                                                <center>
                        <span class="text-danger">
                            No Data Found!
                        </span>
                                                </center>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
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
