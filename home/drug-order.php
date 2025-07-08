<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$output = "";

$server = new Home();

$data = $server->drug_byID();
$h_data = $server->drug_byID();


if (isset($_POST['delete'])) {
    $output = $server->delete_appointment($_POST);
}

if (isset($_POST['change'])) {
    $output = $server->update_login_data($_POST);
}

if(isset($_POST['order'])){

   $output = $server->order_drugs($_POST);
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

        select{
            width: 100%;
            height:35px;
            cursor: pointer
        }
        select option{
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
                <?php

                while ($row = $h_data->fetch_assoc()) {
                    $drug_id = $row['id']
                    ?>
                    <td style="width: 250px">
                        <h1 class="font-weight-300" style="">
                            <u>
                                <?= $row['drug_name'] ?>
                            </u>
                            <small style="font-size: 13px">
                                <?= $row['drug_quantity'] ?>
                            </small>
                        </h1>
                    </td>
                <?php } ?>
            </tr>
        </table>
        <h1 style="color:green"></h1>
    </div>
</div>


<div class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-4" style="min-height:400px">
                <table>

                    <?php
                    if ($data->num_rows > 0) {
                        while ($row = $data->fetch_assoc()) {
                            $partner_id = $row['partner_id'];
                            $name = $row['drug_name'];
                            $quantity = $row['drug_quantity'];
                            $price = $row['unit_price'];
                            ?>
                            <tr>
                                <td><span style="color: orangered">Drug Name</span></td>
                                <td><?= $name ?></td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">Drug Type</span></td>
                                <td><?= $row['drug_type'] ?></td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">Drug Group</span></td>
                                <td><?= $row['drug_group'] ?></td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">Producer</span></td>
                                <td><?= $row['producer'] ?></td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">Weight/Volume</span></td>
                                <td><?= $quantity ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h3>Selected Pharmacy</h3>
                                </td>
                            </tr>
                            <tr>
                                <td><span style="color: orangered">Pharmacy Name</span></td>
                                <td>
                                    <a href="pharmacy-details.php?partner_id=<?= $row['partner_id'] ?>" target="_blank">
                                        <?= $row['institute_name'] ?> [ <span style="color:orangered">Check</span> ]
                                    </a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="7">
                                <center>
                                    <span class="text-danger">Sorry! No Data Found.</span>
                                </center>
                            </td>
                        </tr>
                    <?php } ?>

                </table>

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
                <h3 style="">Order Details</h3>
                <form method="POST" action="" oninput="total.value=parseFloat(a.value)*parseFloat(b.value)+parseInt(c.value)">
                    <input type="hidden"  name="partner_id" value="<?= $partner_id; ?>"/>
                    <input type="hidden"  name="drug_id" value="<?= $drug_id; ?>"/>
                    <input type="hidden"  name="drug_name" value="<?= $name; ?>"/>
                    <input type="hidden"  name="drug_quantity" value="<?= $quantity; ?>"/>
                    <table>
                        <tr>
                            <td>Unit Price <small>(BDT)</small></td>
                            <td><input value="<?= $price ?>" id="a" style="width: 100px;text-align: center" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><input type="number" min="1" id="b" name="order_quantity" style="width: 100px;text-align: center" required/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <select id="c" required name="delivery_type">
                                    <option value="" selected disabled>Select Delivery Method</option>
                                    <option value="100" style="cursor: pointer">Home Delivery [ 100 BDT ]</option>
                                    <option value="0">Physical</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: orangered"><b>TOTAL PRICE [BDT]</b></td>
                            <td><input style="width: 100px;text-align: center" name="total" for="a b c" readonly/></td>
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
                                <button type="submit" class="btn btn-primary" name="order" style="width: 100%">Order Now</button>
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
