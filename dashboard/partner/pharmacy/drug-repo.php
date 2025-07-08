<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"]) && !isset($_SESSION["zone"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';

$result = "";
$output = "";

$server = new Partner();

$result = $server->partner_data();

$data = $server->view_drugs();

if(isset($_POST['delete'])){
    $output = $server->remove_drug($_POST);
}

if(isset($_POST['update'])){
    $output = $server->update_drug_info($_POST);
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

</head>

<body>

<div class="main-wrapper">
    <?php while ($row = $result->fetch_assoc()) {
        $profile_status = $row['profile_status']
        ?>
        <!--topnav-->
        <?php include './parts/top-nav.php'; ?>

        <!--sidenav-->
        <?php include './parts/side-nav.php'; ?>

    <?php } ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="page-title"><u>Drug Repository</u>&emsp;
                        <span class="text-success"><?= $output ?></span>
                    </h4>
                </div>
                <div class="col-sm-4">
                    <a href="drug-add.php" class="btn btn-primary btn-rounded float-right">
                        <i class="fa fa-plus-circle"></i>&nbsp;Add Drug
                    </a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <input id="myInput" type="text" placeholder="Search ...."
                                   style="height: 35px;width: 40%;border: 1px solid;text-align: center">
                            <a href="#" class="btn btn-outline-dark float-right">Total Drugs:
                                <span style="color: orangered"><?= $server->total_drugs() ?></span>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="d-none">
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Doctor Name</th>
                                        <th>Timing</th>
                                        <th class="text-right">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    <?php
                                    $i = 1;
                                    $x = 1;
                                    if ($data->num_rows > 0) {
                                        while ($row = $data->fetch_assoc()) {
                                            ?>

                                            <tr>
                                                <td>
                                                    <h5 class="time-title p-0">Name</h5>
                                                    <p><?= $row['drug_name'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Type</h5>
                                                    <p><?= $row['drug_type'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Group</h5>
                                                    <p><?= $row['drug_group'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Producer</h5>
                                                    <p><?= $row['producer'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Unit Price</h5>
                                                    <p><?= $row['unit_price'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Quantity</h5>
                                                    <p><?= $row['drug_quantity'] ?></p>
                                                </td>
                                                <td>
                                                    <h5 class="time-title p-0">Status</h5>
                                                    <?php if ($row['publication_status'] === '1') { ?>
                                                        <p class="text-success">Published</p>
                                                    <?php } else { ?>
                                                        <p class="text-danger">Unpublished</p>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-right">
                                                    <form method="POST" action="drug-repo.php">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                        <a href="#modal<?= $i++ ?>"
                                                                class="btn btn-outline-primary take-btn" title="Update">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button type="submit" name="delete" onclick="return confirm('Are you really sure to remove?')"
                                                                class="btn btn-outline-danger take-btn" title="Remove">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <div class="awesome-modal" id="modal<?= $x++ ?>">
                                                <a class="close-icon" href="#close"></a>
                                                <div class="row">
                                                    <div class="col-lg-10 offset-lg-1">
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="serial_no" value="<?= $row['id'] ?>" />
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Drug Name <span class="text-danger">*</span></label>
                                                                        <input class="form-control" type="text" name="drug_name" value="<?= $row['drug_name'] ?>" placeholder="Enter Drug Name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Drug Type <span class="text-danger">*</span></label>
                                                                        <select class="form-control" name="drug_type" required >
                                                                            <option value="">Select</option>
                                                                            <option value="Liquid" <?php if($row['drug_type'] === 'Liquid'){echo 'selected';} ?>>Liquid</option>
                                                                            <option value="Tablet" <?php if($row['drug_type'] === 'Tablet'){echo 'selected';} ?>>Tablet</option>
                                                                            <option value="Capsule"  <?php if($row['drug_type'] === 'Capsule'){echo 'selected';} ?>>Capsule</option>
                                                                            <option value="Drop"  <?php if($row['drug_type'] === 'Drop'){echo 'selected';} ?>>Drop</option>
                                                                            <option value="Inhaler"  <?php if($row['drug_type'] === 'Inhaler'){echo 'selected';} ?>>Inhaler</option>
                                                                            <option value="Injection" <?php if($row['drug_type'] === 'Injection'){echo 'selected';} ?>>Injection</option>
                                                                            <option value="Suppository" <?php if($row['drug_type'] === 'Suppository'){echo 'selected';} ?>>Suppository</option>
                                                                            <option value="Topical" <?php if($row['drug_type'] === 'Topical'){echo 'selected';} ?>>Topical</option>
                                                                            <option value="Patch" <?php if($row['drug_type'] === 'Patch'){echo 'selected';} ?>>Implant or patch</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Drug Group<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="drug_group" value="<?= $row['drug_group'] ?>" placeholder="Enter Drug Group" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Producer/Company<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="producer" value="<?= $row['producer'] ?>" placeholder="Enter Producer's Name" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Unit Price [In Taka]<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="unit_price" value="<?= $row['unit_price'] ?>" placeholder="Enter Unit Price" type="number" min="0" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Quantity<span class="text-danger">*</span></label>
                                                                        <input class="form-control" name="drug_quantity" value="<?= $row['drug_quantity'] ?>" placeholder="Enter Drug Quantity" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Publication Status <span class="text-danger">*</span></label>
                                                                        <select class="form-control" name="status" required style="border: 1px solid">
                                                                            <option value="">Select</option>
                                                                            <option value="1" <?php if($row['publication_status'] === '1'){echo 'selected';} ?>>Published</option>
                                                                            <option value="0" <?php if($row['publication_status'] === '0'){echo 'selected';} ?>>Unpublished</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12">
                                                                    <center>
                                                                        <button class="btn btn-primary" type="submit" name="update">Update &nbsp;
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                    }else{ ?>
                                        <tr>
                                            <td colspan="">
                                                <center>
                                                   <span class="text-danger">
                                                       This repository is empty.
                                                   </span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'parts/notifications.php' ?>

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