<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './server/Admin.php';
$result = "";
$categoryData = "";
$categoryID = "";

$server = new Admin();
$result = $server->adminData();
$message = "";
$categoryData = $server->category_data();
$categoryID = $server->category_data();

if (isset($_POST['delete'])) {
    $message = $server->delete_category($_POST);
}
if (isset($_POST['update'])) {
    $message = $server->update_category_status($_POST);
}
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
            <?php while ($row = $result->fetch_assoc()) { ?>
                <!--topnav-->
                <?php include './parts/top-nav.php'; ?>

                <!--sidenav-->
                <?php include './parts/side-nav.php'; ?>

            <?php } ?>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-8 col-6">
                            <h4 class="page-title">Test Repository<?php echo $message; ?></h4>
                        </div>

                        <div class = "col-sm-4 col-6 text-right m-b-30">
                            <a href = "new-test.php" class = "btn btn-primary"><i class = "fa fa-plus"></i> Create New</a>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-sm-2"></div>
                        <div class = "col-sm-8">
                            <input id="myInput" list = "id" placeholder= "Search...."/>
                            <datalist id = "id">
                                <?php
                                while ($row = $categoryID->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['category_name'] ?>"><?php echo $row['category_id'] ?></option>
                                <?php } ?>
                            </datalist>
                            <table class="table">
                                <?php $i = 1; ?>
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category Name</th>
                                        <th>Total Test</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    if ($categoryData->num_rows > 0) {
                                        while ($row = $categoryData->fetch_assoc()) {
                                            ?>
                                            <tr>

                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $row['category_name'] ?></td>
                                                <td><?php
                                                    $id = $row['category_id'];
                                                    echo $server->test_total_byID($id);
                                                    ?></td>
                                                <td>
                                                    <a href="test-by-category.php?category_id=<?php echo $row['category_id']; ?>" title="Details">
                                                        <span class="btn btn-dark" >
                                                            <i class="fa fa-book" ></i>
                                                        </span>
                                                    </a>
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