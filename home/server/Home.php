<?php

class Home
{

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'dams');
    }

    protected function mail_sending($data)
    {
    }

    //    partners

    public function partner_singup($data)
    {
        date_default_timezone_set("Asia/Dhaka");
        $partnerid = "partner@" . date("Y-m-d") . '?' . date("H:i:s");
        $code = date("His");

        if (empty($data['email']) || empty($data['password']) || empty($data['confirm_password'])) {
            return $error = '<span style="color:red">Please fill-up all of the fields.</span>';
        } elseif ($data['password'] != $data['confirm_password']) {
            return $error = '<span style="color:red">Passwords do not match.</span>';
        } else {

            $sql = "SELECT email FROM `partners` WHERE email = '$data[email]'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                return $error = '<span style="color:red">Choose different email address</span>';
            } else {

                require("../mailer/PHPMailer/src/PHPMailer.php");
                require("../mailer/PHPMailer/src/SMTP.php");

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP(); // enable SMTP

                $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = "projectdams291@gmail.com";
                $mail->Password = "diagnosticassistant";
                $mail->SetFrom("xxxxxx@xxxxx.com");
                $mail->Subject = "Verification Code";
                $mail->Body = "This is your DAMS verification code " . $code;
                $mail->AddAddress("$data[email]");

                if (!$mail->Send()) {
                    return "Mailer Error: " . $mail->ErrorInfo;
                } else {


                    $_SESSION['partnerid'] = $partnerid;
                    $_SESSION['partner_email'] = $data['email'];
                    $_SESSION['zone'] = $data['zone'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['verification_code'] = $code;

                    header('location: partner-email-confirmation.php');
                }
            }
        }
    }


    public function partner_email_confirmation($data)
    {

        $partnerid = $_SESSION['partnerid'];
        $email = $_SESSION['partner_email'];
        $zone = $_SESSION['zone'];
        $password = $_SESSION['password'];
        $code = $_SESSION['verification_code'];
        date_default_timezone_set("Asia/Dhaka");
        $joining_date = date("d-m-Y");

        if ($data['code'] === $code && $data['email'] === $email) {
            $sql = "INSERT INTO `partners`(`partner_id`,`partnership_zone`,`email`, `password` ,`joining_date` , `mail_verification`) VALUES ('$partnerid','$zone','$email','$password','$joining_date', '1')";
            if ($this->conn->query($sql) === TRUE) {
                header('location: ../login/partners/');
            } else {
                return $this->conn->error;
            }
        } else {
            return $error = "Code doesn't match";
        }
    }

    public function client_email_check($data)
    {
        $sql = "SELECT `email` FROM `clients` WHERE email = '$data[email]'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return 'Chose different email address.';
        } else {

            $code = date("His");
            require("../mailer/PHPMailer/src/PHPMailer.php");
            require("../mailer/PHPMailer/src/SMTP.php");

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP(); // enable SMTP

            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "projectdams291@gmail.com";
            $mail->Password = "diagnosticassistant";
            $mail->SetFrom("xxxxxx@xxxxx.com");
            $mail->Subject = "Verification Code";
            $mail->Body = "This is your DAMS verification code " . $code;
            $mail->AddAddress("$data[email]");

            if (!$mail->Send()) {
                return "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $_SESSION['client_email'] = $data['email'];
                $_SESSION['verification_code'] = $code;
                header('location: client-contact-confirmation.php');
            }
        }
    }

    public function client_contact_confirmation($data)
    {

        $code = $_SESSION['verification_code'];

        if ($data['code'] == $code) {
            header('location: client-sign-up.php');
        } else {
            return $error = "Code doesn't match";
        }
    }

    public function client_signup($data)
    {
        date_default_timezone_set("Asia/Dhaka");
        $client_id = "client@" . date("Y-m-d") . '?' . date("H:i:s");
        $joining_date = date("d-m-Y");

        if (empty($data['first_name']) || empty($data['last_name']) || empty($data['phone']) || empty($data['email']) || empty($data['username']) || empty($data['password']) || empty($data['confirm_password'])) {
            return $error = '<span style="color:red">Please fill-up all of the fields.</span>';
        } elseif ($data['password'] != $data['confirm_password']) {
            return $error = '<span style="color:red">Passwords do not match.</span>';
        } else {
            $sql = "SELECT username FROM `clients` where username = '$data[username]'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {

                return '<span class="text-danger">Sorry! Username is takken already.</span>';

            } else {
               
                $sql = "INSERT INTO `clients`(`client_id`,`first_name`, `last_name`, `phone`, `email`, `country`, `city`, `address`, `username`, `password`, `joining_date`) VALUES "
                    . "('$client_id','$data[first_name]','$data[last_name]','$data[phone]','$data[email]','$data[country]','$data[city]','$data[address]','$data[username]','$data[password]','$joining_date')";
                if ($this->conn->query($sql) === TRUE) {

                    $_SESSION['logged_in'] = 'logged_in';
                    $_SESSION['client_id'] = $client_id;

                    echo "<script type='text/javascript'>alert('Congrats! You are logged in.');document.location='index.php';</script>";
                } else {
                }
            }
        }
    }


    public function category_data()
    {
        $sql = "SELECT *FROM category ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function test_data()
    {
        $sql = "SELECT * FROM `available_tests` WHERE status = 1 ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function test_between_prices($data)
    {

        $sql = "SELECT *FROM `available_tests` WHERE test_price  BETWEEN '$data[price_from]' AND '$data[price_to]'";
        $result = $this->conn->query($sql);
        return $result;
    }


    public function search_test($data)
    {
        if (empty($data['category_id']) && empty($data['test_id'])) {
            echo "<script type='text/javascript'>alert('Please select a category or a test name.');document.location='index.php';</script>";
        } elseif (!empty($data['category_id']) && empty($data['test_id'])) {
            $sql = "SELECT * FROM `tests` WHERE category_id = '$data[category_id]'";
            $result = $this->conn->query($sql);
            return $result;
        } elseif (empty($data['category_id']) && !empty($data['test_id'])) {
            $sql = "SELECT * FROM `tests` WHERE test_id = '$data[test_id]'";
            $result = $this->conn->query($sql);
            return $result;
        } elseif (!empty($data['category_id']) && !empty($data['test_id'])) {
            $sql = "SELECT * FROM `tests` WHERE test_id = '$data[test_id]' AND category_id = '$data[category_id]'";
            $result = $this->conn->query($sql);
            return $result;
        }
    }

    public function categoryName_byID($category_id)
    {
        $sql = "SELECT category_name FROM `category` WHERE category_id = '$category_id' ";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            return $row['category_name'];
        }
    }

    public function test_avaibility()
    {
        $test_id = $_GET['test_id'];
        $sql = "SELECT * FROM `available_tests` WHERE test_id = '$test_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function tests_byLab()
    {
        $lab = $_GET['partner_id'];
        $sql = "SELECT * FROM `available_tests` WHERE partner_id = '$lab'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function viewtest_data()
    {
        $test_id = $_GET['test_id'];
        $partner_id = $_GET['partner_id'];
        $sql = "SELECT * FROM `available_tests` WHERE partner_id = '$partner_id' AND test_id = '$test_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function name_by_id($partner_id)
    {
        $sql = "SELECT institute_name FROM `partners` WHERE partner_id = '$partner_id' ";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            return $row['institute_name'];
        }
    }

    public function location_by_id($partner_id)
    {
        $sql = "SELECT country,city,region FROM `partners` WHERE partner_id = '$partner_id' ";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            return $row['region'] . ',' . $row['city'] . ',' . $row['country'];
        }
    }

    public function testName_byID($test_id)
    {
        $sql = "SELECT test_name FROM `tests` WHERE test_id = '$test_id' ";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            return $row['test_name'];
        }
    }

    public function appointment_request($data)
    {

        $request_from = $_SESSION['client_id'];
        $request_to = $_GET['partner_id'];
        $requested_test = $_GET['test_id'];
        $test_price = $_GET['test_id'];

        $requested_date = date("d-m-Y", strtotime($data['requested_date']));

        date_default_timezone_set("Asia/Dhaka");
        $appointment_id = "appointment@" . date("Y-m-d") . '?' . date("H:i:s");

        $sql = "INSERT INTO `appointments`(`appointmnet_id`,`appointment_type`, `request_from`, `request_to`, `requested_test`, `requested_date`,`test_name`,`test_price`,`request_status` ) VALUES "
            . "('$appointment_id','test','$request_from','$request_to','$requested_test','$requested_date','$data[test_name]','$data[test_price]','1')";
        if ($this->conn->query($sql)) {
            return $message = "Request Received. Please check your dashboard.";
        } else {
            return $this->conn->error;
        }
    }

    public function client_profile()
    {
        $client_id = $_SESSION['client_id'];
        $sql = "SELECT *FROM `clients` WHERE client_id = '$client_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }


    public function test_appointments()
    {
        $client_id = $_SESSION['client_id'];
        $sql = "SELECT * FROM `appointments` WHERE request_from = '$client_id' AND appointment_type = 'test'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function doctor_appointments()
    {
        $client_id = $_SESSION['client_id'];
        $sql = "SELECT * FROM `appointments` WHERE request_from = '$client_id' AND appointment_type = 'doctor'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function delete_appointment($data)
    {
        $sql = "DELETE FROM `appointments` WHERE id = '$data[id]'";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Cancelled!');document.location='dashboard.php';</script>";
        } else {
            return $this->conn->error;
        }
    }

    public function cancel_order($data)
    {
        $client_id = $_SESSION['client_id'];
        $sql = "UPDATE `drugs_ordered` SET `is_delivered`=0,`is_received`=0,`is_pending`=0,`is_processing`=0,`is_cancelled`=1,`cancelled_by`='$client_id' WHERE id = '$data[id]'";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Cancelled!');document.location='dashboard.php';</script>";
        } else {
            return $this->conn->error;
        }
    }

    public function mark_as_received($data)
    {

        $sql = "UPDATE `drugs_ordered` SET `is_received`=1,`is_pending`=0,`is_processing`=0,`is_cancelled`=0  WHERE id = '$data[id]'";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Marked as received!');document.location='dashboard.php';</script>";
        } else {
            return $this->conn->error;
        }
    }

    public function update_propic($data)
    {
        $client_id = $_SESSION['client_id'];
        $directory = '../gallery/clients/propic/';

        $propic = $directory . basename($_FILES['propic']['name']);

        if (file_exists($propic)) {
            echo "<script type='text/javascript'>alert('Sorry! file name exists!');document.location='dashboard.php';</script>";
        } else {
            $sql = "UPDATE `clients` SET `propic`= '$propic' WHERE client_id = '$client_id'";
            if ($this->conn->query($sql) === TRUE) {
                move_uploaded_file($_FILES['propic']['tmp_name'], $propic);
                unlink($data['oldpic']);
                header('location:dashboard.php#close');
            } else {
                return $this->conn->error;
            }
        }
    }

    public function update_login_data($data)
    {
        $client_id = $_SESSION['client_id'];
        if ($data['password'] === $data['confirm_password']) {
            $sql = "UPDATE `clients` SET `username`= '$data[username]' ,`password`= '$data[password]'  WHERE client_id ='$client_id'";
            if ($this->conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Updated!');document.location='dashboard.php';</script>";
            } else {
                return $this->conn->error;
            }
        } else {
            echo "<script type='text/javascript'>alert('Sorry! passwords do not match!');document.location='dashboard.php#modalz';</script>";
        }
    }

    public function update_profile($data)
    {
        $client_id = $_SESSION['client_id'];

        $sql = "UPDATE `clients` SET `first_name`='$data[first_name]',`last_name`='$data[last_name]',`phone`='$data[phone]',`email`='$data[email]',`country`='$data[country]',`city`='$data[city]',`address`='$data[address]' WHERE client_id ='$client_id'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:dashboard.php#close');
        } else {
            return $this->conn->error;
        }
    }

    public function invoice()
    {
        $id = $_GET['appointmnet_id'];
        $sql = "SELECT * FROM `appointments` WHERE appointmnet_id = '$id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    //    pharmacy

    public function view_pharmacies()
    {
        $sql = "SELECT * FROM `partners` WHERE partnership_zone = 'pharmacy' AND status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function view_branches()
    {
        $sql = "SELECT * FROM `branches` WHERE partnership_zone = 'pharmacy' AND status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function pharmacy_byID($data)
    {
        $sql = "SELECT * FROM `partners` WHERE partner_id = '$data[partner_id]' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function pharmacyData_byGet()
    {

        $partner_id = $_GET['partner_id'];

        $sql = "SELECT * FROM `partners` WHERE partner_id = '$partner_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function branchData_byGet()
    {

        $branch_id = $_GET['branch_id'];

        $sql = "SELECT * FROM `branches` WHERE branch_id = '$branch_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function pharmacyBranch_byGet()
    {

        $partner_id = $_GET['partner_id'];

        $sql = "SELECT * FROM `branches` WHERE partner_id = '$partner_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function pharmacyBranch_byID($data)
    {
        $sql = "SELECT * FROM `branches` WHERE id = '$data[id]' ";
        $result = $this->conn->query($sql);
        return $result;
    }


    //    drugs

    public function view_drugs()
    {
        $sql = "SELECT * FROM `drugs` WHERE publication_status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function drug_byID()
    {
        $id = $_GET['id'];

        $sql = "SELECT * FROM `drugs` WHERE id = '$id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function drugs_byPharmacy()
    {
        $partner_id = $_GET['partner_id'];

        $sql = "SELECT * FROM `drugs` WHERE partner_id = '$partner_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function order_drugs($data)
    {

        $client_id = $_SESSION['client_id'];
        $orderid = "order@" . date("Y-m-d") . '?' . date("H:i:s");

        $time = date("d-m-Y");

        if ($data['delivery_type'] === '100') {
            $delivery_type = 'Home Delivery';
        } elseif ($data['delivery_type'] === '0') {
            $delivery_type = 'Physical';
        }
        $sql = "INSERT INTO `drugs_ordered`(`client_id`, `partner_id`,`order_id`,`drug_id`, `drug_name`, `drug_quantity`, `order_quantity`, `delivery_type`, `total_price`, `ordered_on`) VALUES
           ('$client_id','$data[partner_id]','$orderid','$data[drug_id]','$data[drug_name]','$data[drug_quantity]','$data[order_quantity]','$delivery_type','$data[total]','$time')";

        if ($this->conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Order received. We wil contact you soon.!');document.location='drugs.php';</script>";
        } else {
            return $this->conn->error;
        }
    }

    public function order_by_prescription($data)
    {

        $client_id = $_SESSION['client_id'];
        $orderid = "order@" . date("Y-m-d") . '?' . date("H:i:s");

        $time = date("d-m-Y");

        $directory = '../gallery/prescriptions/';

        $image = $directory . basename($_FILES['prescription_image']['name']);

        if (file_exists($image)) {
            echo "<script type='text/javascript'>alert('Sorry! File name exists. Rename your file or choose another one.');</script>";
        } else {
            $sql = "INSERT INTO `prescriptions`(`order_id`,`client_id`, `partner_id`, `prescription_image`, `ordered_on`) VALUES
           ('$orderid','$client_id','$data[partner_id]','$image','$time')";

            if ($this->conn->query($sql) === TRUE) {
                move_uploaded_file($_FILES['prescription_image']['tmp_name'], $image);
                echo "<script type='text/javascript'>alert('Order received. We wil contact you soon.');document.location='pharmacy.php';</script>";
            } else {
                return $this->conn->error;
            }
        }
    }

    public function orders()
    {
        $client_id = $_SESSION['client_id'];

        $sql = "SELECT *FROM `drugs_ordered` WHERE client_id = '$client_id' ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }


    //    doctors

    public function view_doctors()
    {
        $sql = "SELECT * FROM `partners` WHERE partnership_zone = 'doctor' AND status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function doctor_appointment_request($data)
    {

        $request_from = $_SESSION['client_id'];
        $request_to = $_GET['partner_id'];

        $requested_date = date("d-m-Y", strtotime($data['requested_date']));

        date_default_timezone_set("Asia/Dhaka");
        $appointment_id = "appointment@" . date("Y-m-d") . '?' . date("H:i:s");

        $sql = "INSERT INTO `appointments`(`appointmnet_id`,`appointment_type`, `request_from`, `request_to`, `requested_date`,`visit_price`,`request_status` ) VALUES "
            . "('$appointment_id','doctor','$request_from','$request_to','$requested_date','$data[visit_price]','1')";
        if ($this->conn->query($sql)) {
            echo "<script type='text/javascript'>alert('Request received. Check your dashboard.');document.location='doctors.php';</script>";
        } else {
            return $this->conn->error;
        }
    }

    public function doctor_branches()
    {

        $partner_id = $_GET['partner_id'];

        $sql = "SELECT * FROM `branches` WHERE partner_id = '$partner_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function find_doctors($data)
    {
        $sql = "SELECT * FROM `partners` WHERE MATCH (country,city,region,doctor_type) AGAINST ('$data')";
        $result = $this->conn->query($sql);
        return $result;
    }

    //labs

    public function view_labs()
    {
        $sql = "SELECT * FROM `partners` WHERE partnership_zone = 'lab' AND status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function lab_branches()
    {
        $sql = "SELECT * FROM `branches` WHERE partnership_zone = 'lab' AND status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function labs_byID($data)
    {
        $sql = "SELECT * FROM `partners` WHERE partner_id = '$data[partner_id]' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function labBranch_byID($data)
    {
        $sql = "SELECT * FROM `branches` WHERE id = '$data[id]' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function total_notification()
    {

        $client_id = $_SESSION['client_id'];

        $sql = "SELECT id FROM `notifications` WHERE notification_to = '$client_id' AND is_seen = 0";
        $result = $this->conn->query($sql);
        $total = $result->num_rows;
        return $total;
    }

    public function notifications()
    {

        $client_id = $_SESSION['client_id'];

        $sql = "SELECT *FROM `notifications` WHERE notification_to = '$client_id' ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function notification_seen()
    {
        $client_id = $_SESSION['client_id'];
        $sql = "UPDATE `notifications` SET `is_seen`='1' WHERE notification_to = '$client_id'";
        if ($this->conn->query($sql) === TRUE) {
        } else {
        }
    }


    public function received_messages()
    {
        $client_id = $_SESSION['client_id'];
        $sql = "SELECT * FROM `messages` WHERE `message_to` = '$client_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function mark_as_seen($data)
    {
        $sql = "UPDATE `messages` SET `is_seen`= 1 WHERE `message_id` = '$data[message_id]'";
        if ($this->conn->query($sql) === TRUE) {
            header('location:dashboard.php');
        } else {
        }
    }
}
