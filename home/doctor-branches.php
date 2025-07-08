<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$output = "";

$server = new Home();

$data = $server->doctor_branches();


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
        <form method="GET" action="doctor-search.php">
            <table style="border: none">
                <tr>
                    <td style="width: 250px">
                        <h1 class="font-weight-300" style="text-transform: uppercase;margin-left: -20px">
                            <u>Branches of <?= $_GET['doctor_title'] ?></u>
                        </h1>
                    </td>
                    <td>
                        <input id="myInput" placeholder="Search for name,country,city,region." style="width:270px" class="form-control">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<div class="">
    <div class="container">
        <div class="row" style="min-height: 400px">

            <table>
                <tr>
                    <th>Institute Name</th>
                     <th>Country</th>
                    <th>City</th>
                    <th>Region</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                <tbody id="myTable">
                <?php
                $i = 1;
                if ($data->num_rows > 0) {
                    while ($row = $data->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $row['institute_name'] ?></td>
                            <td><?= $row['country'] ?></td>
                            <td><?= $row['city'] ?></td>
                            <td><?= $row['region'] ?></td>
                            <td><?= $row['address'] ?></td>
                          <td>
                                <a href="branch-details.php?partner_id=<?= $row['partner_id'] ?>&branch_id=<?= $row['branch_id'] ?>" class="btn btn-outline-primary">
                                    Take Up
                                </a>
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
                <?php } ?>
                </tbody>
            </table>
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
