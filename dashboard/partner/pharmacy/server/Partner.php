<?php

class Partner
{

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'dams');
    }

    public function partner_data()
    {
        $partner_id = $_SESSION['partner_id'];
        $sql = "SELECT *FROM partners WHERE partner_id = '$partner_id' AND status = '1'";
        $result = $this->conn->query($sql);
        return $result;
    }

//    change password

    public function change_password($data)
    {
        $partner_id = $_SESSION['partner_id'];

        $sql = "SELECT id FROM `partners` WHERE partner_id = '$partner_id' AND email ='$data[email]' AND password = '$data[current_password]' ";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $sql = "UPDATE `partners` SET password = '$data[new_password]' WHERE partner_id = '$partner_id'";
            if($this->conn->query($sql) === TRUE){
                return 1;
            }else{
                return 0;
            }
        }else{
            return $error ="Current login details do not match.";
        }
    }


    public function update_profile($data)
    {

        $partner_id = $_SESSION['partner_id'];

        $directory = '../../gallery/propic/partners/';

        if ($_FILES['institute_logo']['name'] == "") {
            $logo = $_SESSION['institute_logo'];
        } else {
            $logo = $directory . basename($_FILES['institute_logo']['name']);
            move_uploaded_file($_FILES['institute_logo']['tmp_name'], $logo);
        }

        $sql = "UPDATE `partners` SET "
            . "`institute_name`='$data[institute_name]',"
            . "`institute_type`='$data[institute_type]',"
            . "`service_period`='$data[service_period]',"
            . "`off_days`='$data[off_days]',"
            . "`short_form`='$data[short_form]',"
            . "`tin_number`='$data[tin_number]',"
            . "`reg_number`='$data[reg_number]',"
            . "`contact_no1`='$data[contact_no1]',"
            . "`contact_no2`='$data[contact_no2]',"
            . "`contact_no3`='$data[contact_no3]',"
            . "`hotline_no`='$data[hotline_no]',"
            . "`address`='$data[address]',"
            . "`country`='$data[country]',"
            . "`city`='$data[city]',"
            . "`region`='$data[region]',"
            . "`website_link`='$data[website_link]',"
            . "`facebook_link`='$data[facebook_link]',"
            . "`institute_logo`='$logo',"
            . "`about`='$data[about]',"
            . "`email`='$data[email]',"
            . "`password`='$data[password]',"
            . "`profile_status`= '1'"
            . " WHERE partner_id = '$partner_id'";

        if ($this->conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('UPDATED!');document.location='profile-details.php';</script>";
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }


    //pharmacy

    public function add_drug($data)
    {
        $partner_id = $_SESSION['partner_id'];

        $sql = "INSERT INTO `drugs`(`partner_id`,`institute_name`,`drug_name`, `drug_type`, `drug_group`, `producer`, `unit_price`, `drug_quantity`, `publication_status`) VALUES 
               ('$partner_id','$data[institute_name]','$data[drug_name]','$data[drug_type]','$data[drug_group]','$data[producer]','$data[unit_price]','$data[drug_quantity]','$data[status]')";
        if ($this->conn->query($sql) === TRUE) {
            return $message = 'New drug added to repository.';
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }

    public function total_drugs()
    {
        $query = "SELECT COUNT(id) FROM `drugs` ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }


    public function view_drugs()
    {
        $sql = "SELECT * FROM `drugs` ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function remove_drug($data)
    {
        $sql = "DELETE FROM `drugs` WHERE id = '$data[id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:drug-repo.php');
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }

    public function update_drug_info($data)
    {
        $sql = "UPDATE `drugs` SET 
               `drug_name`= '$data[drug_name]',
                `drug_type`= '$data[drug_type]',
                `drug_group`= '$data[drug_group]',
                `producer`= '$data[producer]',
                `unit_price`= '$data[unit_price]',
                `drug_quantity` = '$data[drug_quantity]',
                `publication_status` = '$data[status]'
                 WHERE `id` = '$data[serial_no]'";

        if ($this->conn->query($sql) === TRUE) {
            header('location:drug-repo.php#close');
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }

    //    branches

    public function create_branch($data)
    {
        $partner_id = $_SESSION['partner_id'];
        $branch_id = "branch@" . date("Y-m-d") . '?' . date("H:i:s");
        $sql = "INSERT INTO `branches`(`partner_id`,`branch_id`, `institute_name`, `partnership_zone`, `institute_logo`, `address`, `country`, `city`, `region`, `contact_no1`, `contact_no2`, `contact_no3`, `hotline_no`, `email`, `service_period`, `off_days`, `status`) VALUES 
       ('$partner_id','$branch_id','$data[institute_name]','$data[partnership_zone]','$data[institute_logo]','$data[address]','$data[country]','$data[city]','$data[region]','$data[contact_no1]','$data[contact_no2]','$data[contact_no3]','$data[hotline_no]','$data[email]','$data[service_period]','$data[off_days]','$data[status]')";
        if ($this->conn->query($sql) === TRUE) {
            return $message = 'New branch added in the list.';
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }

    }

    public function view_branches()
    {
        $partner_id = $_SESSION['partner_id'];
        $sql = "SELECT * FROM `branches` WHERE partner_id = '$partner_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function update_branch_info($data)
    {
        $sql = "UPDATE `branches` SET 
                `country`= '$data[country]',
                `city`= '$data[city]',
                `region`= '$data[region]',
                `address`= '$data[address]',
                `contact_no1`='$data[contact_no1]',
                `contact_no2`='$data[contact_no2]',
                `contact_no3`='$data[contact_no3]',
                `hotline_no`='$data[hotline_no]',
                `email`='$data[email]',
                `service_period`='$data[service_period]',
                `off_days`='$data[off_days]',
                `status`= '$data[status]'
                WHERE `id` = '$data[serial_no]'";

        if ($this->conn->query($sql) === TRUE) {
            header('location:branch-list.php#close');
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }

    public function total_branch()
    {
        $partner_id = $_SESSION['partner_id'];
        $query = "SELECT COUNT(id) FROM `branches`  WHERE partner_id = '$partner_id'";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function remove_branch($data)
    {
        $sql = "DELETE FROM `branches` WHERE id = '$data[id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:branch-list.php');
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }

    //    packages

    public function package_bronze()
    {
        $sql = "SELECT * FROM `packages` WHERE package_name = 'Bronze'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function package_silver()
    {
        $sql = "SELECT * FROM `packages` WHERE package_name = 'Silver'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function package_gold()
    {
        $sql = "SELECT * FROM `packages` WHERE package_name = 'Gold'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function package_platinum()
    {
        $sql = "SELECT * FROM `packages` WHERE package_name = 'Platinum'";
        $result = $this->conn->query($sql);
        return $result;
    }

//    verifications

    public function account_verification($data)
    {
        $partner_id = $_SESSION['partner_id'];

        $directory1 = '../../gallery/tin-certificates/';
        $directory2 = '../../gallery/license-certificates/';

        $filename1 = $_FILES['tin_certificate']['name'];
        $filename2 = $_FILES['licence_certificate']['name'];
        $maxsize = 5242880;

        if ($_FILES['tin_certificate']['name'] == "") {

            $error = "Front image is required!";
            return $error;

        } elseif ($_FILES['licence_certificate']['name'] == "") {

            $error = "Front image is required!";
            return $error;

        } elseif ($_FILES['tin_certificate']['size'] > $maxsize || $_FILES['licence_certificate']['size'] > $maxsize) {

            $error = "One or both image are too large in size. Max allowed size is 5 MB!";
            return $error;
        } elseif (!preg_match("/\.(png|jpg|jpeg)$/", $filename1, $filename2)) {
            $error = "File type is not allowed!";
            return $error;
        } else {


            $tin = $directory1 . basename($_FILES['tin_certificate']['name']);
            $license = $directory2 . basename($_FILES['licence_certificate']['name']);

            date_default_timezone_set("Asia/Dhaka");
            $id = "verification@" . date("d-m-Y") . '?' . date("H:i:s");

            $sql = "INSERT INTO `verification`(`partner_id`, `verification_id`, `verification_type`, `tin_certificate`, `license_certificate`) VALUES"
                . " ('$partner_id','$id','account','$tin','$license')";

            if ($this->conn->query($sql) === TRUE) {

                $sql = "UPDATE `partners` SET `account_request`= 1 WHERE partner_id = '$partner_id' ";
                if ($this->conn->query($sql)) {
                    header("Location: verify-account.php");
                } else {
                    return $this->conn->error;
                }
                move_uploaded_file($_FILES['tin_certificate']['tmp_name'], $tin);
                move_uploaded_file($_FILES['licence_certificate']['tmp_name'], $license);
            }
        }
    }

    public function location_verification($data)
    {
        $partner_id = $_SESSION['partner_id'];

        date_default_timezone_set("Asia/Dhaka");
        $id = "verification@" . date("d-m-Y") . '?' . date("H:i:s");

        $sql = "INSERT INTO `verification`(`partner_id`, `verification_id`, `verification_type`,`map_name`, `longitude`, `latitude`) VALUES "
            . "('$partner_id','$id','location','$data[map_name]','$data[longitude]','$data[latitude]')";

        if ($this->conn->query($sql) === TRUE) {

            $sql = "UPDATE `partners` SET `location_request`= 1 WHERE partner_id = '$partner_id' ";
            if ($this->conn->query($sql)) {
                header("Location: verify-location.php");
            } else {
                return $this->conn->error;
            }
        }
    }

    public function get_premium($data)
    {
        $partner_id = $_SESSION['partner_id'];
        $sql = "UPDATE `partners` SET `premium_status`= 1 WHERE partner_id = '$partner_id' ";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Payment Received!');document.location='index.php';</script>";
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }

    public function try_again()
    {
        $partner_id = $_SESSION['partner_id'];
        $sql = "UPDATE `partners` SET `verification_failed`= 0,`failed_cause`= '' WHERE partner_id = '$partner_id' ";
        if ($this->conn->query($sql) === TRUE) {
            header("Location:verify-account.php");
        } else {
            return $this->conn->error;
        }
    }


//    orders

    public function totalOrders_forDrugs()
    {
        $query = "SELECT COUNT(id) FROM `drugs_ordered` WHERE is_pending = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function totalOrders_byPrescriptions()
    {
        $query = "SELECT COUNT(id) FROM `prescriptions` WHERE is_pending = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function totalCancelled_drugOrders()
    {
        $query = "SELECT COUNT(id) FROM `drugs_ordered` WHERE is_cancelled = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function totalCancelled_prescriptions()
    {
        $query = "SELECT COUNT(id) FROM `prescriptions` WHERE is_cancelled = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function totalDelivered_drugOrders()
    {
        $query = "SELECT COUNT(id) FROM `drugs_ordered` WHERE is_delivered = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function totalDelivered_prescriptions()
    {
        $query = "SELECT COUNT(id) FROM `prescriptions` WHERE is_delivered = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }


    public function totalProcessing_drugOrders()
    {
        $query = "SELECT COUNT(id) FROM `drugs_ordered` WHERE is_processing = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function totalProcessing_prescriptions()
    {
        $query = "SELECT COUNT(id) FROM `prescriptions` WHERE is_processing = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function ordersFor_drugs()
    {
        $sql = "SELECT * FROM `drugs_ordered` WHERE is_pending = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function ordersBy_prescriptions()
    {
        $sql = "SELECT * FROM `prescriptions` WHERE is_pending = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function cancelled_drugOrders()
    {
        $sql = "SELECT * FROM `drugs_ordered` WHERE is_cancelled = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function cancelled_prescriptions()
    {
        $sql = "SELECT * FROM `prescriptions` WHERE is_cancelled = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function delivered_drugOrders()
    {
        $sql = "SELECT * FROM `drugs_ordered` WHERE is_delivered = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function delivered_prescriptions()
    {
        $sql = "SELECT * FROM `prescriptions` WHERE is_delivered = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function processing_drugOrders()
    {
        $sql = "SELECT * FROM `drugs_ordered` WHERE is_processing = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function processing_prescriptions()
    {
        $sql = "SELECT * FROM `prescriptions` WHERE is_processing = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }


    public function drugOrder_delivered($data)
    {
        date_default_timezone_set("Asia/Dhaka");
        $date = date('d-m-Y');
        $sql = "UPDATE `drugs_ordered` SET `delivered_on`='$date',is_pending = 0 ,`is_delivered`=1 WHERE order_id = '$data[order_id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:orders-pending.php#close');
        } else {
            echo $this->conn->error;
        }
    }

    public function drugOrder_processing($data)
    {
        $sql = "UPDATE `drugs_ordered` SET is_pending = 0 ,`is_processing`=1 WHERE order_id = '$data[order_id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:orders-pending.php#close');
        } else {
            echo $this->conn->error;
        }
    }

    public function drugOrder_cancelled($data)
    {
        $sql = "UPDATE `drugs_ordered` SET is_pending = 0 ,`is_cancelled`=1 WHERE order_id = '$data[order_id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:orders-pending.php#close');
        } else {
            echo $this->conn->error;
        }
    }

    public function prescription_delivered($data)
    {
        date_default_timezone_set("Asia/Dhaka");
        $date = date('d-m-Y');
        $sql = "UPDATE `prescriptions` SET is_pending = 0 ,`delivered_on`='$date',`is_delivered`=1 WHERE order_id = '$data[order_id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:orders-pending.php#close');
        } else {
            echo $this->conn->error;
        }
    }

    public function prescription_processing($data)
    {
        $sql = "UPDATE `prescriptions` SET is_pending = 0 ,`is_processing`=1 WHERE order_id = '$data[order_id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:orders-pending.php#close');
        } else {
            echo $this->conn->error;
        }
    }

    public function prescription_cancelled($data)
    {
        $sql = "UPDATE `prescriptions` SET is_pending = 0 ,`is_cancelled`=1 WHERE order_id = '$data[order_id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:orders-pending.php#close');
        } else {
            echo $this->conn->error;
        }
    }


    //    clients

    public function client_profile($client_id)
    {
        $sql = "SELECT *FROM `clients` WHERE client_id = '$client_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    //    posts

    public function view_posts()
    {
        $sql = "SELECT * FROM `posts` WHERE `posted_for` = 'pharmacies' AND `publication_status` = 1 ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    //    Messages
    public function send_message($data)
    {
        $partner_id = $_SESSION['partner_id'];
        date_default_timezone_set('Asia/Dhaka');
        $message_id = "message@" . date("Y-m-d") . '?' . date("H:i:s");
        $notification_id = "notification@" . date("Y-m-d") . '?' . date("H:i:s");
        $time = date("l ,F j, Y, g:i a");


        if(empty($data['message_body'])){
            $error = "This field is required.";
            return $error;
        }else{
            $sql = "INSERT INTO `messages`(`message_id`, `message_from`, `message_to`, `message_for`,`message_owner`,`message_body`, `sent_on`) VALUES 
              ('$message_id','$partner_id','$data[message_to]','admin','partner','$data[message_body]','$time')";
            if ($this->conn->query($sql) === TRUE) {
                $sql = "INSERT INTO `notifications`(`notification_id`, `notification_to`, `notification_from`, `notification_type`, `notification_about`, `notification_for`, `notification_time`) VALUES
              ('$notification_id','admin','$partner_id','message','A new message received.','$for','$time')";
                if ($this->conn->query($sql) === TRUE) {
                    header('location:message-send.php?message=Message has been sent successfully!');
                } else {

                }
            } else {

            }
        }
    }

    public function sent_messages()
    {
        $partner_id = $_SESSION['partner_id'];
        $sql = "SELECT * FROM `messages` WHERE `message_from` = '$partner_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function received_messages()
    {
        $partner_id = $_SESSION['partner_id'];
        $sql = "SELECT * FROM `messages` WHERE `message_to` = '$partner_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function mark_as_seen($data){
        $sql="UPDATE `messages` SET `is_seen`= 1 WHERE `message_id` = '$data[message_id]'";
        if($this->conn->query($sql) === TRUE){
            header('location:message-inbox.php');
        }else{

        }
    }

    public function get_notifications()
    {
        $partner_id = $_SESSION['partner_id'];
        $sql = "SELECT * FROM `notifications` WHERE notification_to = '$partner_id' ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function notification_seen($type)
    {
        $partner_id = $_SESSION['partner_id'];
        $sql = "UPDATE `notifications` SET `is_seen`='1' WHERE notification_to = '$partner_id' AND notification_type = '$type'";
        if ($this->conn->query($sql) === TRUE) {

        } else {

        }
    }

    //    totals

    public function total_notification()
    {
        $partner_id = $_SESSION['partner_id'];
        $query = "SELECT COUNT(id) FROM `notifications` WHERE notification_to = '$partner_id' AND is_seen = 0";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }


}
