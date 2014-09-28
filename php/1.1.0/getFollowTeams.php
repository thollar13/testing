<?php

ob_start();

$host="192.168.2.7"; // Host name 
$username="TallyRecWebUser"; // mysqli username 
$password="webt00l"; // mysqli password 
$db_name="tallyrec"; // Database name 
$tbl_name="myteams"; // Table name 

// Connect to server and select databse.
mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db("$db_name")or die("cannot select DB");

// Load  Variables
$username = $_REQUEST['username'];

$sql="SELECT * FROM $tbl_name WHERE (username = '$username') AND (Archived != '1') AND ( manager = '2') ORDER BY name ASC";
$result = mysqli_query($sql);    
// mysqli_num_row is counting table row
$count=mysqli_num_rows($result);

echo "<ul data-role='listview' data-inset='true'>";
    echo "<li data-role='list-divider' data-role='button' data-icon='search' data-iconpos='notext'>Following</li>";
    echo "<li data-icon='search'><a href='#search'>Search for teams to follow...</a></li>";

// Get SQL Results
while ($row = mysqli_fetch_assoc($result)) {
    
    echo "<li class='ui-field-contain ui-body ui-br ui-btn-up-c ui-corner-top'>";
    
    echo "<a data-teamid='" . $row["teamid"] . "' data-teamname='" . htmlspecialchars($row["name"], ENT_QUOTES) . "' data-manager='" . $row["manager"] . "' rel='external' data-ajax='false' class='createteamlink ui-link-inherit' data-transition='slide'>";
    
    echo "<img src='";
    // Check Sport
    if ($row["SportID"]=="1") {
        echo "images/sport/1.png";
    }
    else if ($row["SportID"]=="2") {
        echo "images/sport/2.png";
    }else if ($row["SportID"]=="3") {
        echo "images/sport/3.png";
    }else if ($row["SportID"]=="4") {
        echo "images/sport/4.png";
    }else if ($row["SportID"]=="5") {
        echo "images/sport/5.png";
    }else if ($row["SportID"]=="6") {
        echo "images/sport/6.png";
    }else if ($row["SportID"]=="7") {
        echo "images/sport/7.png";
    }else if ($row["SportID"]=="8") {
        echo "images/sport/8.png";
    }else if ($row["SportID"]=="9") {
        echo "images/sport/9.png";
    }else if ($row["SportID"]=="10") {
        echo "images/sport/10.png";
    }else if ($row["SportID"]=="11") {
        echo "images/sport/11.png";
    }else if ($row["SportID"]=="12") {
        echo "images/sport/12.png";
    }else if ($row["SportID"]=="13") {
        echo "images/sport/13.png";
    }else if ($row["SportID"]=="14") {
        echo "images/sport/14.png";
    }else if ($row["SportID"]=="15") {
        echo "images/sport/15.png";
    }
    else if ($row["SportID"]=="16") {
        echo "images/sport/16.png";
    }
    else if ($row["SportID"]=="18") {
        echo "images/sport/18.png";
        }
    else {
        echo "images/sport/Default.png";
    }
    
    echo "' alt='test' class='ui-li-icon' />";
        echo $row["name"];
        
    echo "</a>";
    echo "</li>";
 
}
if($count=="0"){
}
echo "</ul>";

ob_end_flush();

?>