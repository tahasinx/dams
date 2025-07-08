<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$server = new Home();
$search = "";

$category = $server->category_data();
$test = $server->test_data();

$result = $server->test_avaibility();

if (isset($_GET['submit'])) {
    $search = $server->search_test($_GET);
}

$i = 1;
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
                <h3 style="color:orangered"><?php echo $server->testName_byID($_GET['test_id']); ?></h3>
                <h1 class="font-weight-300">AVAILABLE LOCATIONS</h1>
            </div>
        </div>


        <div class="margin-tb-30px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            <br>
                            <table class="table-dark text-center" border="1px solid">
                                <thead>
                                    <tr>
                                        <th style="color:white">Serial</th>
                                        <th style="color:white">Institute Name</th>
                                        <th style="color:white">Location</th>
                                        <th style="color:white">Price</th>
                                        <th style="color:white">Discount</th>
                                        <th style="color:white"> Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td style="text-align:center"><?php echo $i++; ?></td>
                                                <td style="text-align:center"><?php
                                                    $id = $row['partner_id'];
                                                    $name = $server->name_by_id($id);
                                                    echo $name;
                                                    ?></td>
                                                <td style="text-align:center"><?php echo $server->location_by_id($row['partner_id']) ?></td>
                                                <td style="text-align:center"><?php echo $row['test_price'] ?></td>
                                                <td style="text-align:center"><?php echo $row['test_discount'] ?> %</td>
                                                <td style="text-align:center">
                                                    <a href="location-on-map.php?institute_name=<?php echo $name; ?>" class="btn btn-success" onclick="window.open(this.href, 'popUpWindow', 'height=500,width=1000'); return false;">
                                                        Map
                                                    </a>
                                                    <a href="request-appointment.php?test_id=<?php echo $row['test_id'] ?>&partner_id=<?php echo $row['partner_id'] ?>" class="btn btn-primary">
                                                        Take Up
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4">
                                    <center>
                                        <span style="color:red;" class="text-center">No Data Exists!</span>
                                    </center>
                                    </td>

                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>


                        </div>



                    </div>
                    <div class="col-lg-4">

                        <div class="background-white border-radius-10 margin-bottom-45px">
                            <div class="padding-25px">
                                <h3 class="margin-lr-20px"><i class="fa fa-search margin-right-10px text-main-color"></i>
                                    Price Filter</h3>
                                <!-- Listing Search -->
                                <div class="listing-search">
                                    <form method="GET" action="test-filtered.php">
                                        <div class="keywords margin-bottom-20px">
                                            <input class="listing-form first" name="price_from" type="number" min="0" placeholder="Price From BDT" required/>
                                        </div>

                                        <div class="keywords margin-bottom-20px">
                                            <input class="listing-form first" name="price_to" type="number" min="0" placeholder="Price To BDT" required/>
                                        </div>

                                        <?php if (!isset($_SESSION["logged_in"])) { ?>
                                            <a class="listing-bottom background-dark box-shadow border-radius-10" href="#modal">Search
                                                Now</a>
                                            <div class="awesome-modal" id="modal"><a class="close-icon" href="#close"></a>
                                                <center>
                                                    <h3 class="modal-title text-danger">You are not logged in?</h3>
                                                    <br>
                                                    <a class="btn btn-success" href="../login/clients/" style="width: 80px">Login</a>&emsp;||&emsp;<a
                                                            class="btn btn-dark" href="client-sign-up.php" style="">Sign up</a>
                                                </center>
                                            </div>

                                        <?php } else {
                                            ?>
                                            <button type="submit" name="submit"
                                                    class="listing-bottom background-dark box-shadow border-radius-10">Search
                                                Now
                                            </button>

                                        <?php } ?>

                                    </form>
                                </div>
                                <!-- // Listing Search -->
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
