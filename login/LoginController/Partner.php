<?php

class Partner {

    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'dams');
    }

    public function partner_login($data) {

        $sql = "SELECT *FROM `partners` WHERE email = '$data[email]' AND password = '$data[password]'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['status'] == 0 || $row['mail_verification'] == 0 ) {
                    return $message = '<span style="color:red">Sorry! You are not authorized!</span>';
                } else {
                    $partnerid = $row['partner_id'];
                    $zone      = $row['partnership_zone'];


                    if($zone === 'clinic'){
                        $_SESSION['partner_id'] = $partnerid;
                        $_SESSION['zone'] = $zone;
                        header('location:../../dashboard/partner/clinic/index.php');
                    }elseif ($zone === 'doctor'){
                        $_SESSION['partner_id'] = $partnerid;
                        $_SESSION['zone'] = $zone;
                        header('location:../../dashboard/partner/doctor/index.php');
                    }elseif($zone === 'lab'){
                        $_SESSION['partner_id'] = $partnerid;
                        $_SESSION['zone'] = $zone;
                        header('location:../../dashboard/partner/lab/index.php');
                    }elseif ($zone === 'pharmacy'){
                        $_SESSION['partner_id'] = $partnerid;
                        $_SESSION['zone'] = $zone;
                        header('location:../../dashboard/partner/pharmacy/index.php');
                    }else{
                        return $message = '<span style="color:red">Sorry! You are not authorized!</span>';
                    }


                }
            }
        } else {
            return $message = '<span style="color:red">Incorrect Login Details!</span>';
        }
    }

}
