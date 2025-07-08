<?php
session_start();

require_once './server/Home.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
}

$server = new Home();
$search = "";
$output = "";

$category = $server->category_data();
$test = $server->test_data();

$result = $server->test_avaibility();

if (isset($_GET['submit'])) {
    $search = $server->search_test($_GET);
}

if (isset($_POST['send'])) {
    $output = $server->appointment_request($_POST);
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
                <h1 class="font-weight-300" style="text-transform: uppercase">Request for an appointment</h1>
                <h1 style="color:green"><?php echo $output; ?></h1>
            </div>
        </div>


        <div class="margin-tb-30px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="">
                                <form method="POST" action="">
                                    <table>
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td>Institute Name:</td>
                                                <td><?php echo $server->name_by_id($row['partner_id']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Location:</td>
                                                <td><?php echo $server->location_by_id($row['partner_id']) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Test Price</td>
                                                <td><?php echo $row['test_price'] ?> [ <span style="color:orangered">In Taka</span> ]</td>
                                            </tr>
                                            <tr>
                                                <td>Discount</td>
                                                <td><?php echo $row['test_discount'] ?> %</td>
                                            </tr>
                                            <tr>
                                                <td>Appointment Date</td>
                                                <td><input type="date" name="requested_date" required/></td>
                                            </tr>
                                            <tr>
                                                <td><h3><b>Total Amount:</b></h3></td>
                                                <td><?php
                                                    $total = $row['test_price'];
                                                    $discount = $row['test_discount'];
                                                    $discount_amount = preg_replace('/\D/', '', $discount);

                                                    $total = $total - ($total * ($discount_amount / 100));
                                                    echo $total;
                                                    ?> [ <span style="color:orangered">In Taka</span> ]
                                                    <input name="test_price" type="hidden" value="<?php echo $total; ?>">
                                                    <input name="test_name" type="hidden" value="<?php echo $server->testName_byID($_GET['test_id']); ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="submit" name="send" class="btn btn-primary" value="Send Request" style="width: 100%"/>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </form>
                            </div>
                        </div>



                    </div>
                    <div class="col-lg-4">
                        
                        <div class="background-white border-radius-10 margin-bottom-45px">
                            <div class="padding-25px">
                                <h3 class="margin-lr-20px"><i class="fas fa-search margin-right-10px text-main-color"></i> Search Filter</h3>
                                <!-- Listing Search -->
                                <div class="listing-search">
                                    <form method="GET" action="">
                                        <div class="keywords margin-bottom-20px">
                                            <select class="listing-form first" name="category_id" >
                                                <option selected disabled> Category</option>
                                                <?php while ($row = $category->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                                                <?php }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="regions margin-bottom-20px">
                                            <select class="listing-form first" name="test_id" >
                                                <option selected disabled> Test Name</option>
                                                <?php while ($row = $test->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['test_id'] ?>"><?php echo $row['test_name'] ?></option>
                                                <?php }
                                                ?>

                                            </select>
                                        </div>

                                        <?php if (!isset($_SESSION["logged_in"])) { ?>
                                            <a class="listing-bottom background-dark box-shadow border-radius-10" href="#modal">Search Now</a>
                                            <div class="awesome-modal" id="modal"><a class="close-icon" href="#close"></a>
                                                <center>
                                                    <h3 class="modal-title text-danger">You are not logged in?</h3>
                                                    <br>
                                                    <a class="btn btn-success" href="../login/clients/" style="width: 80px">Login</a>&emsp;||&emsp;<a class="btn btn-dark" href="client-sign-up.php" style="">Sign up</a>
                                                </center>
                                            </div>

                                        <?php } else {
                                            ?>
                                            <button type="submit" name="submit" class="listing-bottom background-dark box-shadow border-radius-10" >Search Now</button>

                                        <?php } ?>
                                    </form>
                                </div>
                                <!-- // Listing Search -->
                            </div>
                        </div>


                        <div class="featured-categorey">
                            <div class="row">
                                <div class="col-6 margin-bottom-30px wow fadeInUp">
                                    <a href="#" class="d-block border-radius-15 hvr-float hvr-sh2">
                                        <div class="background-main-color text-white border-radius-15 padding-30px text-center opacity-hover-7">
                                            <div class="icon margin-bottom-15px opacity-7">
                                                <img src="assets/img/icon/categorie-1.png" alt="">
                                            </div>
                                            Doctors
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 margin-bottom-30px wow fadeInUp" data-wow-delay="0.2s">
                                    <a href="#" class="d-block border-radius-15 hvr-float hvr-sh2">
                                        <div class="background-main-color text-white border-radius-15 padding-30px text-center opacity-hover-7">
                                            <div class="icon margin-bottom-15px opacity-7">
                                                <img src="assets/img/icon/categorie-2.png" alt="">
                                            </div>
                                            Clinics
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.4s">
                                    <a href="#" class="d-block border-radius-15 hvr-float hvr-sh2">
                                        <div class="background-main-color text-white border-radius-15 padding-30px text-center opacity-hover-7">
                                            <div class="icon margin-bottom-15px">
                                                <img src="assets/img/icon/categorie-3.png" alt="">
                                            </div>
                                            Labs
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.6s">
                                    <a href="#" class="d-block border-radius-15 hvr-float hvr-sh2">
                                        <div class="background-main-color text-white border-radius-15 padding-30px text-center opacity-hover-7">
                                            <div class="icon margin-bottom-15px opacity-7">
                                                <img src="assets/img/icon/categorie-4.png" alt="">
                                            </div>
                                            Pharmacies
                                        </div>
                                    </a>
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
