<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$result = "";
$categoryData = "";
$categoryID = "";

$server = new Partner();
$result = $server->partner_data();

$message = "";
$categoryData = $server->category_data();
$categoryID = $server->category_data();

$i = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>DAMS</title>

        <?php
        include './parts/css-links.php';
        ?>
        <style>
            table{
                text-align: center !important;
                font-family: 'Titillium Web', sans-serif !important;
            }
            th{
                background-color: #333333;
                color:white
            }
            input,button{
                text-align: center;
                font-family: 'Titillium Web', sans-serif !important;
            }
            input[type="submit"]{
                width: 100%
            }
            h4{
                font-family: 'Titillium Web', sans-serif !important;
            }
            h4 mark{
                color: blue
            }
        </style>

    </head>

    <body>

        <div class="main-wrapper">
            <?php
            while ($row = $result->fetch_assoc()) {

                $profile_status = $row['profile_status'];
                $premium_status = $row['premium_status'];
                ?>
                <!--topnav-->
                <?php include './parts/top-nav.php'; ?>

                <!--sidenav-->
                <?php include './parts/side-nav.php'; ?>

            <?php } ?>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-8 col-6">
                            <h4 class="page-title"><b><u>SELECT A CATEGORY</u></b><?php echo $message; ?></h4>
                        </div>

                        <div class = "col-sm-4 col-6 text-right m-b-30">
                            <a href="test-repository.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-pencil"></i>Repository</a> 
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-sm-2"></div>
                        <div class = "col-sm-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title d-inline-block">TEST CATEGORIES</h4><input class="float-right" id="myInput" list = "id" placeholder= "Search...."/>
                                    <datalist id = "id">
                                        <?php
                                        while ($row = $categoryID->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['category_name'] ?>"><?php echo $row['category_id'] ?></option>
                                        <?php } ?>
                                    </datalist> 
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="d-none">
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="myTable">
                                                <?php
                                                if ($categoryData->num_rows > 0) {
                                                    while ($row = $categoryData->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <h5 class="time-title p-0">Serial No</h5>
                                                                <p><?php echo $i++; ?></p>
                                                            </td>                
                                                            <td>
                                                                <h5 class="time-title p-0">Category Name</h5>
                                                                <p><?php echo $row['category_name'] ?></p>
                                                            </td>                
                                                            <td>
                                                                <h5 class="time-title p-0">Total Test</h5>
                                                                <p><?php
                                                                    $id = $row['category_id'];
                                                                    echo $server->test_total_byID($id);
                                                                    ?>
                                                                </p>
                                                            </td>
                                                            <td class="text-right">
                                                                <?php if ($profile_status == 0 || $premium_status == 0) { ?>
                                                                    <a href="#modal1" class="btn btn-outline-primary take-btn">Take up</a>
                                                                <?php } else { ?>
                                                                    <a href="create-test.php?category_id=<?php echo $row['category_id']; ?>&category_name=<?php echo $row['category_name']; ?>" title="Select" class="btn btn-outline-primary take-btn">Take up</a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="4">
                                                            <span style="color:red;text-align: center">No Data Found !</span>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php if ($profile_status == 0 && $premium_status <> 0) { ?>

                                            <!--modal-->
                                            <div class="awesome-modal" id="modal1"><a class="close-icon" href="#close"></a>
                                                <center>
                                                    <h3 class="modal-title">You have to complete your profile first.</h3>
                                                    <br>
                                                    <a href="update-profile.php" class="btn btn-success">Complete Profile</a>
                                                </center>
                                            </div>
                                        <?php } elseif ($profile_status <> 0 && $premium_status == 0) { ?>
                                            <!--modal-->
                                            <div class="awesome-modal" id="modal1"><a class="close-icon" href="#close"></a>
                                                <center>
                                                    <h3 class="modal-title">You are not premium.</h3>
                                                    <br>
                                                    <a href="premium-packages.php" class="btn btn-primary">Get Premium</a>
                                                </center>
                                            </div>
                                        <?php } elseif ($profile_status == 0 && $premium_status == 0) { ?>
                                            <!--modal-->
                                            <div class="awesome-modal" id="modal1"><a class="close-icon" href="#close"></a>
                                                <center>
                                                    <h3 class="modal-title">Your profile is incomplete and you are not premium.</h3>
                                                    <br>
                                                     <a href="update-profile.php" class="btn btn-success">Complete Profile</a>
                                                    &emsp;||&emsp;
                                                    <a href="premium-packages.php" class="btn btn-primary">Get Premium</a>
                                                </center>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
                <?php include './parts/messages.php'; ?>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>

        <!--scripts-->
        <?php include './parts/js-links.php'; ?>
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
    </body>
</html>