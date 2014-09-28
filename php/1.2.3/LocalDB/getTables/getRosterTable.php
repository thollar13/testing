<?php

ob_start();

// Set Database variable    
$host="192.168.2.7"; // Host name 
$username="TallyRecWebUser"; // mysqli username 
$password="webt00l"; // mysqli password 
$db_name="tallyrec"; // Database name 
$tbl_name="user"; // Table name 

// Connect to server and select databse.
mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db("$db_name")or die("cannot select DB");

// Define Variable
$username = $_REQUEST['username'];

// To protect mysqli injection (more detail about mysqli injection)
$username = stripslashes($username);
$username = mysqli_real_escape_string($username);

if ($username == "" || $username == null){
    //Must Have Username To Proceed
    echo "Unauthorized Access";
}
else {

    /*
     * Get UserID
     */
    
    $sql="SELECT UserID FROM $tbl_name WHERE (Username ='$username')";
    $result=mysqli_query($sql);
    $row = mysqli_fetch_assoc($result);

    $userid = $row['UserID'];
    
    /*
     * Get Associated TeamID's From Roster
     */
    
    $teamid = array();
    $arraycount = 0;
    
    $sql="SELECT * FROM Roster WHERE (UserID ='$userid') AND (Inactive != '1')";
    $result=mysqli_query($sql);
    $count=mysqli_num_rows($result);

    if($count==0){
        //Do Nothing
    }
    else {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "INSERT INTO ROSTER (TeamID, UserID, DummyUserID, Manager, PlayerNumber, Nickname, Inactive, Archived, AcceptTeamNote, AcceptChat, AcceptFollowNote)";
            echo " VALUES ('" . $row['TeamID'] . "', '" . $row['UserID'] . "', '" . $row['DummyUserID'] . "', '" . $row['Manager'] . "', '" . $row['PlayerNumber'] . "', '" . $row['Nickname'] . "', '" . $row['Inactive'] . "', '" . $row['Archived'] . "', '" . $row['AcceptTeamNote'] . "', '" . $row['AcceptChat'] . "', '" . $row['AcceptFollowNote'] . "')";
            
            echo "<br/>";
            $arraycount++;
        }
    }    
    
}

ob_end_flush();

?>