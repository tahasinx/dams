<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"]) && !isset($_SESSION["zone"])) {
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
                            <h4 class="page-title">Manage Category&emsp;<?php echo $message; ?></h4>
                        </div>

                        <div class = "col-sm-4 col-6 text-right m-b-30">
                            <a href = "new-category.php" class = "btn btn-primary"><i class = "fa fa-plus"></i> Create New</a>
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
                                    <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                                <?php } ?>
                            </datalist>
                            <table class="table">
                                <?php $i = 1; $x = 1;$y = 1; ?>
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category Name</th>
                                        <th>Category ID</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    if ($categoryData->num_rows > 0) {
                                        while ($row = $categoryData->fetch_assoc()) {
                                            ?>
                                            <tr>
                                        <form method="POST" action="">
                                            <td><?php echo $y++; ?></td>
                                            <td><input name="category_name" value="<?php echo $row['category_name'] ?>" /></td>
                                            <td><input name="category_id" value="<?php echo $row['category_id'] ?>" /></td>
                                            <td>

                                            <?php if ($row['status'] == 0) { ?>
                                                    <span class="text-danger">Unoublished</span>
                                                <?php }else{ ?>
                                                    <span class="text-success">Published</span>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <span class="btn btn-success" data-toggle="modal" data-target="#myModal<?php $i++;echo $i++; ?>"><i class="fa fa-book"></i></span>

                                                <?php if ($row['status'] == 0) { ?>
                                                    <input name="status" type="hidden" value="1" />
                                                    ||<button class="btn btn-primary" type="submit" name="update" title="Publish"><i class="fa fa-check" ></i></button>
                                                <?php }else{ ?>
                                                    <input name="status" type="hidden" value="0" />
                                                    ||<button class="btn btn-primary" type="submit" name="update" title="Unpublish"><i class="fa fa-ban" style="color:red"></i></button>
                                                <?php }?>
                                                    ||<button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></button>

                                            </td>
                                        </form>
                                        </tr>
                                        <div class="modal fade" id="myModal<?php $x++; echo $x++; ?>" role="dialog" >
                                            <div class="modal-dialog modal-lg" style="width: 500px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4><b>CATEGORY DESCRIPTION</b></h4><button type="button" class="close" data-dismiss="modal" style="color:red">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $row['description'] ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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