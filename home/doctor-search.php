<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$output = "";

$server = new Home();


$data = $server->find_doctors($_GET['data']);


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
                            <u>Our Doctors</u>
                        </h1>
                    </td>
                    <td>
                        <input id="myInput" name="data" placeholder="Search for name,country,city,region,doctor type." style=""
                               class="form-control" list="type">
                        <datalist id="type">
                            <?php include '../dashboard/doctor-types.php' ?>
                        </datalist>
                    </td>
                    <td>
                        <button type="submit" name="search" class="btn btn-outline-primary">Search</button>
                    </td>
                </tr>
            </table>
        </form>
        <h1 style="color:green"></h1>
    </div>
</div>


<div class="">
    <div class="container">
        <div class="row">
            <section style="margin-bottom: 50px">
                <div class="container">
                    <div class="row">
                        <?php while ($row = $data->fetch_assoc()) { ?>
                            <!-- Doctor -->
                            <a href="doctor-details.php?partner_id=<?= $row['partner_id'] ?>">
                                <div class="col-lg-3 col-md-6 hvr-bob sm-mb-45px" style="min-width: 300px">
                                    <div class="background-white box-shadow wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="thum">
                                            <img src="../dashboard/<?= substr($row['institute_logo'], 6) ?>" alt="">
                                        </div>
                                        <div class="padding-30px">
                                            <span class="text-grey-2"><?= $row['doctor_type'] ?></span>
                                            <h5 class="margin-tb-15px"><a class="text-dark"
                                                                          href="#"><?= $row['doctor_title'] ?></a>
                                            </h5>
                                            <div class="rating clearfix">
                                                <ul class="float-left">
                                                    <li class="active"></li>
                                                    <li class="active"></li>
                                                    <li class="active"></li>
                                                    <li class="active"></li>
                                                    <li></li>
                                                </ul>
                                                <small class="float-right text-grey-2">(17 reviews)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!-- // Doctor -->
                        <?php } ?>
                    </div>
                </div>
            </section>



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
