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
$output = "";
$categoryData = $server->category_data();
$categoryID = $server->category_data();
$output = $server->testData_by_GET($_POST);

if (isset($_POST['view'])) {
    $output = $server->testData_by_POST($_POST);
}
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
                            <form method="POST" action="">
                                <input  list ="id" placeholder= "Search...." name="category_id"/>
                                <datalist id = "id">
                                    <?php
                                    while ($row = $categoryID->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                                    <?php } ?>
                                </datalist>
                                <button type="submit" name="search" class="btn-primary">Search</button>

                            </form>
                        </div>

                        <div class = "col-sm-4 col-6 text-right m-b-30">
                            <a href = "new-test.php" class = "btn btn-primary"><i class = "fa fa-plus"></i> Create New</a>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-sm-12" style="padding: 1%">
                           <?php
                            if ($output->num_rows > 0) {
                                while ($row = $output->fetch_assoc()) {
                                    ?>
                            <div class="card">
                                
                                Test Name: <?php echo $row['test_name'] ?><br>
                                Test Name: <?php echo $row['test_id'] ?><br>
                                Description:<br>
                                <?php echo $row['description'] ?>
                                <iframe width="560" height="315" src="<?php echo $row['video_link'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                
                            </div>

                                    <?php
                                }
                            } else {
                                ?>

                            <?php }
                            ?>

                        </div>
                        
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