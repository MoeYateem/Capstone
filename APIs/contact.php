<?php
header("Access-Control-Allow-Origin: *"); // Replace * with the specific domain if desired
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$conn= mysqli_connect("localhost","root","","ap1");
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
$lname = isset($_POST["lname"]) ? $_POST["lname"] : "";
$company= isset($_POST["company"]) ? $_POST["company"] : "";
$phone_number = isset($_POST["phone_number"]) ? $_POST["phone_number"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$iserror = false;

if (isset($_POST["submit"])){

    $check_email= $conn->query("SELECT email FROM user where email = '$email'");
    
    
    
        if ($email!="" && $fname!="" && $phone_number!="" && $message!="" ){

            $query = $conn->prepare("INSERT INTO contact (fname,lname,company,email,phone_number,message) VALUES ('$fname','$lname','$company','$email','$phone_number','$message')");
            $query->execute();
            

        
        }

    

}

?>