<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$output = "";

$server = new Home();

$data = $server->branchData_byGet();


if (isset($_POST['request'])) {
    $output = $server->doctor_appointment_request($_POST);
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include './parts/css-links.php'; ?>
    <style>
        form, table, h1, h3 {
            font-family: 'Titillium Web', sans-serif;
        }

        table {
            font-size: 15px
        }

        .col-sm-4 li {
            list-style: none;
            font-size: 15px;
        }

        select {
            width: 100%;
            height: 35px;
            cursor: pointer
        }

        select option {
            cursor: pointer !important
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
        <table style="border: none">
            <tr>

            </tr>
        </table>
        <h1 style="color:green"></h1>
    </div>
</div>


<div class="">
    <div class="container">
        <center>
            <h3 style="color: green"> <?= $output ?></h3>
        </center>
        <div class="row">

            <div class="col-sm-4">
                <?php
                while ($row = $data->fetch_assoc()) {
                    $partner_id = $row['partner_id'];
                    $price = $row['visit_price'];
                    ?>
                    <div class="card" style="padding: 3%;margin-bottom: 50px;width: 100%">
                        <table>
                            <tr>
                                <td>
                                    <a href="location-on-map.php?institute_name=<?= $row['address']; ?>,<?= $row['institute_name'] ?>"
                                       onclick="window.open(this.href, 'popUpWindow', 'height=500,width=1000'); return false;"
                                       class="btn btn-outline-primary" title="">
                                        <i class="fa fa-map-marker"></i>&emsp;View Location
                                    </a>
                                </td>
                           </tr>
                            <tr>
                                <td colspan="2">
                                    <h3> <?= $row['doctor_title'] ?></h3>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="5" style="width: 180px">
                                    <img src="../dashboard/<?= substr($row['institute_logo'], 6) ?>"
                                         style="height:150px;width: 150px"/>
                                </td>
                            </tr>
                            <tr>
                                <td><b><?= $row['institute_name'] ?></b></td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">Country:</span><?= $row['country'] ?></td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">City:</span><?= $row['city'] ?></td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">Region:</span><?= $row['region'] ?></td>
                            </tr>
                            <tr>
                                <td>Service Period:</td>
                                <td><?= $service_period = $row['service_period'] ?></td>
                            </tr>
                            <tr>
                                <td>Off Days:</td>
                                <td><?= $off_days = $row['off_days'] ?></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><?= $row['address'] ?></td>
                            </tr>
                            <tr>
                                <td>Contacts</td>
                                <td><?= $row['contact_no1'] ?><br> <?= $row['contact_no2'] ?>
                                    <br> <?= $row['contact_no3'] ?></td>
                            </tr>
                            <tr>
                                <td>Hotline</td>
                                <td><?= $row['hotline_no'] ?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td style="word-break: break-all;"><?= $row['email'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php
                } ?>

            </div>

            <div class="col-sm-4">
                <h3 style="margin-left: 35px">Terms & Conditions</h3>
                <ul>
                    <li>[ 1 ] Terms and Policy must be followed.</li>
                    <br>
                    <li>[ 2 ] Terms and Policy must be followed.</li>
                    <br>
                    <li>[ 3 ] Terms and Policy must be followed.</li>
                    <br>
                    <li>[ 4 ] Terms and Policy must be followed.</li>
                    <br>
                    <li>[ 5 ] Terms and Policy must be followed.</li>
                    <br>
                    <li>[ 6 ] Terms and Policy must be followed.</li>
                </ul>
            </div>
            <div class="col-sm-4 card" style="margin-bottom: 50px">
                <h3 style="">Book Appointment</h3>
                <form method="POST" action="">
                    <input type="hidden" name="partner_id" value="<?= $partner_id; ?>"/>
                    <table>
                        <tr>
                            <td>Off Days:</td>
                            <td><?= $off_days ?></td>
                        </tr>
                        <tr>
                            <td>Service Period:</td>
                            <td><?= $service_period ?></td>
                        </tr>
                        <tr>
                            <td>Visiting Price <small>(IN TAKA)</small></td>
                            <td><input value="<?= $price ?>" name="visit_price" style="width: 100px;text-align: center"
                                       readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="color: orangered"><b>Request For A Date</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="date" name="requested_date" style="width: 100%" required/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="checkbox">
                                    <label style="color: orangered">
                                        <input type="checkbox" id="confirm_password" style="width:20px" required>
                                        I accept the Terms and Conditions.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-primary" name="request"
                                        style="width: 100%;cursor: pointer">
                                    Send Request
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>


<!--footer-->
<?php include './parts/footer.php'; ?>

<!--scripts-->
<?php include './parts/js-links.php'; ?>
</body>
</html>
