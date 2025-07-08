<?php
session_start();

require_once './server/Home.php';

$server = new Home();

$data = $server->invoice();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Invoice</title>

        <?php include './parts/css-links.php'; ?>
        <style>
            .content{
                height: 600px;
                width: 400px;
                border:1px solid;
                padding: 3%;
                font-weight: bold;
                font-size: 15px

            }
            @media print {
                #printPageButton {
                    display: none;
                }
            }
            @page { size: auto;  margin: 0mm; }
        </style>
    </head>
    <body>
    <center>

        <?php while ($row = $data->fetch_assoc()) { ?>
            <div style="margin-top: 3%" class="content">
                <h1><b>PROJECT DAMS</b></h1>
                <br>
                <br>
                <br>
                <table>
                   <tr>
                        <td><mark>Test Center</mark></td>
                        <td><?php echo $server->name_by_id($row['request_to']) ?></td>
                    </tr>
                   <tr>
                        <td><mark>Location</mark></td>
                        <td><?php echo $server->location_by_id($row['request_to']) ?></td>
                    </tr>
                   <tr>
                        <td><mark>Test Name</mark></td>
                        <td><?php echo $row['test_name'] ?></td>
                    </tr>
                    <tr>
                        <td><mark>Appointment_Date</mark></td>
                        <td><?php echo $row['requested_date'] ?></td>
                    </tr>
                    <tr>
                        <td><mark>Test Price</mark></td>
                        <td><?php echo $row['test_price'] ?> BDT</td>
                    </tr>

                </table>
                <b><h2><mark>Appointment ID:</mark> &nbsp;<?php echo $row['appointmnet_id'] ?></h2></b>
                <button id="printPageButton" class="btn btn-outline-dark" onclick="myFunction()" style="cursor: pointer;">Print this token</button>
            </div>
        <?php } ?>
    </center>
    <script>
        function myFunction() {
            window.print();
        }
    </script>
</body>
</html>
