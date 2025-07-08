<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$output = "";

$server = new Home();

$data = $server->pharmacyData_byGet();
$branch = $server->pharmacyBranch_byGet();

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
        form, table, h1, h3 {
            font-family: 'Titillium Web', sans-serif;
        }

        table {
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
        <table style="border: none">
            <tr>
                <td style="width: 250px"><h1 class="font-weight-300" style="text-transform: uppercase;margin-left: -20px"><u>Our Pharmacies</u></h1></td>
                <td><input id="myInput" placeholder="Search for name,country,city,region." style="width: 35%" class="form-control"></td>
            </tr>
        </table>
        <h1 style="color:green"></h1>
    </div>
</div>


<div class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-8" style="min-height:400px">
                <table>
                    <tr>
                        <th>Serial</th>
                        <th>Pharmacy Name</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Region</th>
                        <th>Action</th>
                    </tr>
                    <tbody id="myTable">
                    <?php
                    $i = 1;
                    if ($data->num_rows > 0) {
                        while ($row = $data->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['institute_name'] ?></td>
                                <td><?= $row['country'] ?></td>
                                <td><?= $row['city'] ?></td>
                                <td><?= $row['region'] ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="partner_id" value="<?= $row['partner_id'] ?>"/>
                                        <input class="btn btn-outline-primary" name="search" type="submit"
                                               style="cursor: pointer" value="Take Up"/>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6">
                                <center>
                                    <span class="text-danger">Sorry! No Data Found.</span>
                                </center>
                            </td>
                        </tr>
                    <?php }

                    if ($branch->num_rows > 0) {
                        while ($data = $branch->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $data['institute_name'] ?></td>
                                <td><?= $data['country'] ?></td>
                                <td><?= $data['city'] ?></td>
                                <td><?= $data['region'] ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>"/>
                                        <input class="btn btn-outline-primary" name="search_branch" type="submit"
                                               style="cursor: pointer" value="Take Up"/>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>

                    <?php }
                    ?>
                    </tbody>
                </table>

            </div>
            <div class="col-sm-4" >
                <?php if (isset($_POST['search'])) {
                    $data = $server->pharmacy_byID($_POST);
                    while ($row = $data->fetch_assoc()) {
                        ?>
                        <div class="card" style="padding: 3%">
                            <table>
                                <tr>
                                    <td>
                                        <a href="location-on-map.php?institute_name=<?= $row['address']; ?>,<?= $row['institute_name'] ?>" onclick="window.open(this.href, 'popUpWindow', 'height=500,width=1000'); return false;" class="btn btn-outline-primary" title="">
                                            <i class="fa fa-map-marker"></i>&emsp;View Location
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-outline-dark" style="float: right">
                                            <i class="fa fa-medkit"></i> &emsp; Order Drugs
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
                    }
                } ?>

                <?php if (isset($_POST['search_branch'])) {
                    $data = $server->pharmacyBranch_byID($_POST);
                    while ($row = $data->fetch_assoc()) {
                        ?>
                        <div class="card" style="padding: 3%">
                            <table>
                                <tr>
                                    <td>
                                        <a href="location-on-map.php?institute_name=<?= $row['address']; ?>,<?= $row['institute_name'] ?>" onclick="window.open(this.href, 'popUpWindow', 'height=500,width=1000'); return false;" class="btn btn-outline-primary" title="">
                                            <i class="fa fa-map-marker"></i>&emsp;View Location
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-outline-dark" style="float: right">
                                            <i class="fa fa-medkit"></i> &emsp; Order Drugs
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
                                    <td style="word-break: break-all;"><?= $row['email'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                } ?>
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
