<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$output = "";

$server = new Home();

$data = $server->pharmacyData_byGet();


if (isset($_POST['order'])) {
    $output = $server->order_by_prescription($_POST);
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
        <div class="row">
            <div class="col-sm-4">
                <?php
                while ($row = $data->fetch_assoc()) {
                    $partner_id = $row['partner_id'];
                    ?>
                    <div class="card" style="padding: 3%;margin-bottom: 50px">
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
                                <td><?= $row['service_period'] ?></td>
                            </tr>
                            <tr>
                                <td>Off Days:</td>
                                <td><?= $row['off_days'] ?></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><?= $row['address'] ?></td>
                            </tr>
                            <tr>
                                <td>Contacts</td>
                                <td><?= $row['contact_no1'] ?> <?= $row['contact_no2'] ?> <?= $row['contact_no3'] ?></td>
                            </tr>
                            <tr>
                                <td>Hotline</td>
                                <td><?= $row['hotline_no'] ?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><?= $row['email'] ?></td>
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
                <form method="POST" action=""enctype="multipart/form-data">
                    <input type="hidden" name="partner_id" value="<?= $partner_id ?>">
                    <input type="file" class="form-control" name="prescription_image" required onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    <div style="padding: 3%;border: 1px solid;height: 500px;width: 100%">
                        <img id="blah" alt="your image" style="width: 100%;height: 480px" />
                    </div>
                    <br>
                    <button type="submit" name="order" class="btn btn-outline-primary" style="width: 100%;cursor: pointer">
                        <i class="fa fa-paper-plane"></i> Send Request
                    </button>
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
