<?php

ob_start();

    require("constants.php");
    $tbl_name="user"; // Table name 

    // Define $myusername and $mypassword from form
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    // To protect mysqli injection (more detail about mysqli injection)
    $email = stripslashes($email);
    $email = mysqli_real_escape_string($email);
    $password = stripslashes($password);
    $password = mysqli_real_escape_string($password);
    $str = md5($password);

    // mysqli Update Password
    $sql="UPDATE $tbl_name SET UserPassword = '$str' WHERE (Email='$email')";
    $result=mysqli_query($sql);
    
    // mysqli Update Password
    $sql="SELECT Username FROM $tbl_name WHERE (Email='$email')";
    $result=mysqli_query($sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row["Username"];

    // Mail settings
    $to = $email;
    $subject = "TallyRec - Password Reset";
    $message = "Someone has requested to reset the password for your username: " . $username . "\n" . "
            If this request was made in error, please contact Support@TallyRec.com
            " . "\n\n" . "
            Your new password is: $password " . "\n" . "
            To change this password: Sign in to TallyRec, go to Settings, and update Password.";
    $from = "support@tallyrec.com";
    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
    
ob_end_flush();

?>